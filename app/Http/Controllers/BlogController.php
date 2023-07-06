<?php
namespace App\Http\Controllers;

use App\Facades\Blog;
use App\Services\ThemeAssets;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    const POSTS_PER_PAGE = 6;

    private ThemeAssets $themeAssets;

    public function __construct(
        ThemeAssets $themeAssets
    ) {
        $this->themeAssets = $themeAssets;
    }

    public function list(int $page = 1): Response
    {
        $skip = ($page - 1)  * self::POSTS_PER_PAGE;

        list($posts, $author, $totalPosts) = Blog::getPostsAndAuthor(self::POSTS_PER_PAGE, $skip);

        $prevPageUrl = $nextPageUrl = null;
        if ($page > 1) {
            $prevPage = $page - 1;
            $prevPageUrl = ($prevPage === 1) ? route('home') : route('list', ['page' => $prevPage]);
        }
        if ($totalPosts > ($page * self::POSTS_PER_PAGE)) {
            $nextPage = $page + 1;
            $nextPageUrl = route('list', ['page' => $nextPage]);
        }

        $postsData = [];
        foreach ($posts as $post) {
            $postsData[] = $post->getData();
        }

        $props = array_merge(
            $this->themeAssets->getGlobalProps(),
            [
                'author' => $author->getData(),
                'posts' => $postsData,
                'prevPageUrl' => $prevPageUrl,
                'nextPageUrl' => $nextPageUrl,
            ]
        );

        return Inertia::render('Blog/List', $props);
    }

    public function post(string $slug = ''): Response
    {
        list($post, $author) = Blog::getPostAndAuthor($slug);

        if ($post === null) {
            abort(404);
        }

        $props = array_merge(
            $this->themeAssets->getGlobalProps(),
            [
                'author' => $author->getData(),
                'post' => $post->getData(),
            ]
        );

        return Inertia::render('Blog/Post', $props);
    }
}

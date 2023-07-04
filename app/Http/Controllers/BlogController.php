<?php
namespace App\Http\Controllers;

use App\Facades\Blog;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    const POSTS_PER_PAGE = 10;

    public function list(int $page = 1): Response
    {
        $skip = ($page - 1)  * self::POSTS_PER_PAGE;

        list($posts, $totalPosts) = Blog::getPosts(self::POSTS_PER_PAGE, $skip);

        $prevPageUrl = $nextPageUrl = null;
        if ($page > 1) {
            $prevPage = $page - 1;
            $prevPageUrl = route('list', ['page' => $prevPage]);
        }
        if ($totalPosts > ($page * self::POSTS_PER_PAGE)) {
            $nextPage = $page + 1;
            $nextPageUrl = route('list', ['page' => $nextPage]);
        }

        $postsData = [];
        foreach ($posts as $post) {
            $postsData[] = $post->getData();
        }

        $props = [
            'posts' => $postsData,
            'prevPageUrl' => $prevPageUrl,
            'nextPageUrl' => $nextPageUrl,
        ];

        return Inertia::render('Blog/List', $props);
    }

    public function post(string $slug = ''): Response
    {
        $post = Blog::getPost($slug);

        if ($post === null) {
            abort(404);
        }

        $props = [
            'post' => $post->getData(),
        ];

        return Inertia::render('Blog/Post', $props);
    }
}

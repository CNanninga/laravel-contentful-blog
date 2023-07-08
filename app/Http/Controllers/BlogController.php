<?php
namespace App\Http\Controllers;

use App\Contracts\Blog\Author;
use App\Facades\Blog;
use App\Services\ThemeAssets;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    const POSTS_PER_PAGE = 6;
    const PUBS_PER_PAGE = 10;

    private ThemeAssets $themeAssets;

    public function __construct(
        ThemeAssets $themeAssets
    ) {
        $this->themeAssets = $themeAssets;
    }

    public function home(): Response
    {
        /** @var Author $author */
        list($posts, $author, $totalPosts) = Blog::getPostsAndAuthor(self::POSTS_PER_PAGE, 0);
        if ($author->enableBlogPosts()) {
            return $this->list(1, [$posts, $author, $totalPosts]);
        } else {
            return $this->pubs(1);
        }
    }

    public function list(int $page = 1, ?array $data = null): Response
    {
        $skip = ($page - 1)  * self::POSTS_PER_PAGE;

        if ($data === null) {
            /** @var Author $author */
            list($posts, $author, $totalPosts) = Blog::getPostsAndAuthor(self::POSTS_PER_PAGE, $skip);
        } else {
            /** @var Author $author */
            list($posts, $author, $totalPosts) = $data;
        }

        $prevPageUrl = $nextPageUrl = null;
        if ($page > 1) {
            $prevPage = $page - 1;
            $pageOneRoute = ($author->enableBlogPosts()) ? route('home') : route('list-main');
            $prevPageUrl = ($prevPage === 1) ? $pageOneRoute : route('list', ['page' => $prevPage]);
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
            $this->themeAssets->getGlobalProps($author->enableBlogPosts()),
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
        /** @var Author $author */
        list($post, $author) = Blog::getPostAndAuthor($slug);

        if ($post === null) {
            abort(404);
        }

        $props = array_merge(
            $this->themeAssets->getGlobalProps($author->enableBlogPosts()),
            [
                'author' => $author->getData(),
                'post' => $post->getData(),
            ]
        );

        return Inertia::render('Blog/Post', $props);
    }

    public function pubs(int $page = 1): Response
    {
        $skip = ($page - 1)  * self::PUBS_PER_PAGE;

        /** @var Author $author */
        list($pubs, $author, $totalPubs) = Blog::getPublicationsAndAuthor(self::PUBS_PER_PAGE, $skip);

        $prevPageUrl = $nextPageUrl = null;
        if ($page > 1) {
            $prevPage = $page - 1;
            $pageOneRoute = ($author->enableBlogPosts()) ? route('publications-main') : route('home');
            $prevPageUrl = ($prevPage === 1) ? $pageOneRoute : route('publications', ['page' => $prevPage]);
        }
        if ($totalPubs > ($page * self::PUBS_PER_PAGE)) {
            $nextPage = $page + 1;
            $nextPageUrl = route('publications', ['page' => $nextPage]);
        }

        $pubsData = [];
        foreach ($pubs as $pub) {
            $pubsData[] = $pub->getData();
        }

        $props = array_merge(
            $this->themeAssets->getGlobalProps($author->enableBlogPosts()),
            [
                'author' => $author->getData(),
                'publications' => $pubsData,
                'prevPageUrl' => $prevPageUrl,
                'nextPageUrl' => $nextPageUrl,
            ]
        );

        return Inertia::render('Blog/PublicationsList', $props);
    }
}

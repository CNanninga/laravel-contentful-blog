<?php
namespace App\Services;

use App\Contracts\Blog\Post;
use App\Contracts\BlogRepository;
use App\Services\BlogContentfulRepository\PostsAndAuthor;
use App\Services\BlogContentfulRepository\PostAndAuthor;
use Illuminate\Support\Facades\App;

class BlogContentfulRepository implements BlogRepository
{
    public function getPostsAndAuthor(
        int $limit = 10,
        int $skip = 0
    ): array {
        /** @var PostsAndAuthor $repository */
        $repository = App::make(PostsAndAuthor::class);
        return $repository->execute($limit, $skip);
    }

    public function getPostAndAuthor(
        string $slug
    ): array {
        /** @var PostAndAuthor $repository */
        $repository = App::make(PostAndAuthor::class);
        return $repository->execute($slug);
    }
}

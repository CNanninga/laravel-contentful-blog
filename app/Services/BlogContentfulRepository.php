<?php
namespace App\Services;

use App\Contracts\Blog\Post;
use App\Contracts\BlogRepository;
use App\Services\BlogContentfulRepository\Posts as PostsRepository;
use App\Services\BlogContentfulRepository\Post as PostRepository;
use Illuminate\Support\Facades\App;

class BlogContentfulRepository implements BlogRepository
{
    public function getPosts(
        int $limit = 10,
        int $skip = 0
    ): array {
        /** @var PostsRepository $repository */
        $repository = App::make(PostsRepository::class);
        return $repository->execute($limit, $skip);
    }

    public function getPost(
        string $slug
    ): Post {
        /** @var PostRepository $repository */
        $repository = App::make(PostRepository::class);
        return $repository->execute($slug);
    }
}

<?php
namespace App\Contracts;

use App\Contracts\Blog\Post;

interface BlogRepository
{
    /**
     * @return array(
     *      App\Contracts\Blog\Post[] $posts,
     *      Int $totalPosts
     * )
     */
    public function getPosts(
        int $limit = 10,
        int $skip = 0
    ): array;

    public function getPost(
        string $slug
    ): Post;
}

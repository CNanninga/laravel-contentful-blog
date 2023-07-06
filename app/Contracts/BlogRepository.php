<?php
namespace App\Contracts;

use App\Contracts\Blog\Post;

interface BlogRepository
{
    /**
     * @return array(
     *      App\Contracts\Blog\Post[] $posts,
     *      App\Contracts\Blog\Author $author,
     *      Int $totalPosts
     * )
     */
    public function getPostsAndAuthor(
        int $limit = 10,
        int $skip = 0
    ): array;

    /**
     * @return array(
     *      App\Contracts\Blog\Post $post,
     *      App\Contracts\Blog\Author $author,
     * )
     */
    public function getPostAndAuthor(
        string $slug
    ): array;
}

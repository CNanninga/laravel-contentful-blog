<?php
namespace App\Facades;

use App\Contracts\Blog\Post;
use App\Contracts\BlogRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @see BlogRepository
 *
 * @method static array getPosts(int $limit = 10, int $skip = 0)
 * @see BlogRepository::getPosts
 *
 * @method static Post getPost(string $slug)
 * @see BlogRepository::getPost
 */
class Blog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'blog';
    }
}

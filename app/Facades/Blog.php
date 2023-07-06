<?php
namespace App\Facades;

use App\Contracts\Blog\Post;
use App\Contracts\BlogRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @see BlogRepository
 *
 * @method static array getPostsAndAuthor(int $limit = 10, int $skip = 0)
 * @see BlogRepository::getPostsAndAuthor
 *
 * @method static Post getPostAndAuthor(string $slug)
 * @see BlogRepository::getPostAndAuthor
 */
class Blog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'blog';
    }
}

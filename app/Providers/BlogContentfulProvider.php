<?php

namespace App\Providers;

use App\Contracts\Blog\Author;
use App\Contracts\Blog\Post;
use App\Contracts\Blog\Publication;
use App\Models\Blog\AuthorContentful;
use App\Models\Blog\PostContentful;
use App\Models\Blog\PublicationContentful;
use App\Services\BlogContentfulRepository;
use Illuminate\Support\ServiceProvider;

class BlogContentfulProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Post::class, PostContentful::class);
        $this->app->bind(Author::class, AuthorContentful::class);
        $this->app->bind(Publication::class, PublicationContentful::class);

        $this->app->singleton('blog', function($app) {
            return new BlogContentfulRepository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

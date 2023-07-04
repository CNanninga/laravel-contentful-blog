<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    const POSTS_PER_PAGE = 5;

    public function list(int $page = 1): Response
    {
        $props = [
            'posts' => [
                [
                    'title' => 'A blog post',
                    'slug' => 'a-blog-post',
                    'description' => 'My cool post',
                    'publishDate' => '2023-07-04',
                    'url' => route('post', ['slug' => 'a-blog-post']),
                ]
            ],
            'prevPageUrl' => '/',
            'nextPageUrl' => route('list', ['page' => 2]),
        ];

        return Inertia::render('Blog/List', $props);
    }

    public function post(string $slug = ''): Response
    {
        $props = [
            'post' => [
                'title' => 'A blog post',
                'slug' => 'a-blog-post',
                'description' => 'My cool post',
                'publishDate' => '2023-07-04',
                'url' => route('post', ['slug' => 'a-blog-post']),
                'contentItems' => [
                    'items' => [
                        [
                            '__typename' => 'ContentText',
                            'content' => '<p>First paragraph</p>',
                        ],
                        [
                            '__typename' => 'ContentImage',
                            'image' => [
                                'description' => 'An image',
                                'url' => 'https://images.ctfassets.net/75ususnkkmch/5teRi3fHXYkY4gKQ8a4UdL/9a18e6fc40f67528a74a61590a217654/ben-griffiths-4wxWBy8Jo1I-unsplash.jpg?h=250'
                            ]
                        ]
                    ]
                ]
            ],
        ];

        return Inertia::render('Blog/Post', $props);
    }
}

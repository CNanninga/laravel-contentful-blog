<?php
namespace App\Services;

class ThemeAssets
{
    const ABOUT_ME_POST_SLUG = 'about-me';

    public function getGlobalProps(bool $enableBlogPosts): array
    {
        return [
            'copyrightYear' => date('Y'),
            'navLinks' => $this->getNavLinks($enableBlogPosts),
        ];
    }

    public function getNavLinks(bool $enableBlogPosts): array
    {
        $links = [
            [
                'label' => 'Publications',
                'url' => ($enableBlogPosts) ? route('publications-main') : route('home'),
            ],
            [
                'label' => 'About Me',
                'url' => route('post', ['slug' => self::ABOUT_ME_POST_SLUG]),
            ]
        ];

        if ($enableBlogPosts) {
            $links = array_merge([
                [
                    'label' => 'Blog',
                    'url' => route('home'),
                ],
            ], $links);
        }

        return $links;
    }
}

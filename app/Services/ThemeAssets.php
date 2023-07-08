<?php
namespace App\Services;

class ThemeAssets
{
    const ABOUT_ME_POST_SLUG = 'about-me';

    public function getGlobalProps(): array
    {
        return [
            'copyrightYear' => date('Y'),
            'navLinks' => $this->getNavLinks(),
        ];
    }

    public function getNavLinks(): array
    {
        return [
            [
                'label' => 'Blog',
                'url' => route('home'),
            ],
            [
                'label' => 'Publications',
                'url' => route('publications-main'),
            ],
            [
                'label' => 'About Me',
                'url' => route('post', ['slug' => self::ABOUT_ME_POST_SLUG]),
            ]
        ];
    }
}

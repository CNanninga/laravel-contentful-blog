<?php
namespace App\Services;

class ThemeAssets
{
    public function getGlobalProps(): array
    {
        return [
            'copyrightYear' => date('Y'),
        ];
    }
}

<?php
namespace App\Services;

use Illuminate\Mail\Markdown;

class ContentfulFormatter
{
    public function hydrateSiteUrls(string $content): string
    {
        $baseUrl = url('/');
        return str_replace('{{siteUrl}}', $baseUrl, $content);
    }

    public function formatLongText(?string $text): ?string
    {
        if ($text === null) {
            return null;
        }
        return Markdown::parse($this->hydrateSiteUrls($text))->toHtml();
    }

    public function formatContentRows(array $contentItems): array
    {
        if (!isset($contentItems['items'])) {
            return $contentItems;
        }
        foreach ($contentItems['items'] as &$contentItem) {
            $type = $contentItem['__typename'] ?? null;
            if ($type == 'ContentText' && isset($contentItem['content'])) {
                $contentItem['content'] = Markdown::parse($this->hydrateSiteUrls($contentItem['content']))->toHtml();
            }
        }
        return $contentItems;
    }
}

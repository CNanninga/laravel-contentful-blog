<?php
namespace App\Models\Blog;

use App\Contracts\Blog\Post;
use App\Models\Blog\ContentfulAbstract;
use App\Services\ContentfulFormatter;

class PostContentful extends ContentfulAbstract implements Post
{
    private ContentfulFormatter $contentfulFormatter;

    public function __construct(
        ContentfulFormatter $contentfulFormatter,
        array $graphqlData = [],
        bool $lazyLoad = false
    ) {
        $this->contentfulFormatter = $contentfulFormatter;
        parent::__construct($graphqlData, $lazyLoad);
    }

    public function getTitle(): ?string
    {
        if (!isset($this->data['title'])) {
            $this->data['title'] = $this->graphqlData['title'] ?? '';
        }
        return $this->data['title'];
    }

    public function getDescription(): ?string
    {
        if (!isset($this->data['description'])) {
            $description = $this->graphqlData['description'] ?? null;
            $this->data['description'] = $this->contentfulFormatter->formatLongText($description);
        }
        return $this->data['description'];
    }

    public function getImage(): array
    {
        if (!isset($this->data['image'])) {
            $this->data['image'] = $this->graphqlData['image'] ?? [];
        }
        return $this->data['image'];
    }

    public function getSlug(): ?string
    {
        if (!isset($this->data['slug'])) {
            $this->data['slug'] = $this->graphqlData['slug'] ?? '';
        }
        return $this->data['slug'];
    }

    public function getUrl(): ?string
    {
        if (!isset($this->data['url'])) {
            $this->data['url'] = route('post', ['slug' => $this->graphqlData['slug']]) ?? '';
        }
        return $this->data['url'];
    }

    public function getContentItems(): array
    {
        if (!isset($this->data['contentItemsCollection']['items'])) {
            $contentItems = $this->graphqlData['contentItemsCollection'] ?? [];
            $this->data['contentItems'] = $this->contentfulFormatter->formatContentRows($contentItems);
        }
        return $this->data['contentItems'];
    }

    protected function transformData(): void
    {
        $this->getTitle();
        $this->getDescription();
        $this->getImage();
        $this->getSlug();
        $this->getUrl();
        $this->getContentItems();
    }
}

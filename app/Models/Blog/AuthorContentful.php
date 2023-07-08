<?php
namespace App\Models\Blog;

use App\Contracts\Blog\Author;
use App\Models\Blog\ContentfulAbstract;
use App\Services\ContentfulFormatter;

class AuthorContentful extends ContentfulAbstract implements Author
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

    public function getName(): ?string
    {
        if (!isset($this->data['name'])) {
            $this->data['name'] = $this->graphqlData['name'] ?? '';
        }
        return $this->data['name'];
    }

    public function getImage(): array
    {
        if (!isset($this->data['image'])) {
            $this->data['image'] = $this->graphqlData['image'] ?? [];
        }
        return $this->data['image'];
    }

    public function getTagLine(): ?string
    {
        if (!isset($this->data['tagLine'])) {
            $this->data['tagLine'] = $this->graphqlData['tagLine'] ?? '';
        }
        return $this->data['tagLine'];
    }

    public function getLinkedInUrl(): ?string
    {
        if (!isset($this->data['linkedInUrl'])) {
            $this->data['linkedInUrl'] = $this->graphqlData['linkedInUrl'] ?? '';
        }
        return $this->data['linkedInUrl'];
    }

    public function enableBlogPosts(): bool
    {
        if (!isset($this->data['enableBlogPosts'])) {
            $this->data['enableBlogPosts'] = isset($this->graphqlData['enableBlogPosts'])
                && !($this->graphqlData['enableBlogPosts'] === FALSE);
        }
        return $this->data['enableBlogPosts'];
    }

    protected function transformData(): void
    {
        $this->getName();
        $this->getImage();
        $this->getTagLine();
        $this->getLinkedInUrl();
        $this->enableBlogPosts();
    }
}

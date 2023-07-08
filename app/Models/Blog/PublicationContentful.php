<?php
namespace App\Models\Blog;

use App\Contracts\Blog\Publication;
use App\Models\Blog\ContentfulAbstract;
use App\Services\ContentfulFormatter;

class PublicationContentful extends ContentfulAbstract implements Publication
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

    public function getPublishDate(): ?string
    {
        if (!isset($this->data['publishDate'])) {
            $date = $this->graphqlData['publishDate'] ?? null;
            if ($date) {
                $date = new \DateTime($date);
                $date = $date->format('F j, Y');
            }
            $this->data['publishDate'] = $date;
        }
        return $this->data['publishDate'];
    }

    public function getDescription(): ?string
    {
        if (!isset($this->data['description'])) {
            $description = $this->graphqlData['description'] ?? null;
            $this->data['description'] = $this->contentfulFormatter->formatLongText($description);
        }
        return $this->data['description'];
    }

    public function getUrl(): ?string
    {
        if (!isset($this->data['url'])) {
            $this->data['url'] = $this->graphqlData['url'] ?? '';
        }
        return $this->data['url'];
    }

    public function getSource(): ?string
    {
        if (!isset($this->data['source'])) {
            $this->data['source'] = $this->graphqlData['source'] ?? '';
        }
        return $this->data['source'];
    }

    public function getType(): ?string
    {
        if (!isset($this->data['type'])) {
            $this->data['type'] = $this->graphqlData['type'] ?? '';
        }
        return $this->data['type'];
    }

    protected function transformData(): void
    {
        $this->getTitle();
        $this->getPublishDate();
        $this->getDescription();
        $this->getUrl();
        $this->getSource();
        $this->getType();
    }
}

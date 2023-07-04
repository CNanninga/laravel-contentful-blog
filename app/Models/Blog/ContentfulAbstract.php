<?php
namespace App\Models\Blog;

abstract class ContentfulAbstract
{
    protected array $modelKeys = [];

    protected array $graphqlData = [];
    protected array $data = [];

    public function __construct(array $graphqlData = [], bool $lazyLoad = false)
    {
        $this->graphqlData = $graphqlData;
        if (!$lazyLoad) {
            $this->transformData();
        }
    }

    public function getId(): ?string
    {
        if (!isset($this->data['id'])) {
            $this->data['id'] = $this->graphqlData['sys']['id'] ?? null;
        }
        return $this->data['id'];
    }

    public function getData(): array
    {
        return $this->data;
    }

    abstract protected function transformData(): void;
}

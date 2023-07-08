<?php
namespace App\Contracts\Blog;

interface Publication
{
    public function getTitle(): ?string;

    public function getPublishDate(): ?string;

    public function getDescription(): ?string;

    public function getUrl(): ?string;

    public function getSource(): ?string;

    public function getType(): ?string;

    public function getData(): array;

}

<?php
namespace App\Contracts\Blog;

interface Post
{
    public function getTitle(): ?string;

    public function getPublishDate(): ?string;

    public function getDescription(): ?string;

    public function getImage(): array;

    public function getSlug(): ?string;

    public function getUrl(): ?string;

    public function getContentItems(): array;

    public function getData(): array;

}

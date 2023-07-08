<?php
namespace App\Contracts\Blog;

interface Author
{
    public function getName(): ?string;

    public function getImage(): array;

    public function getTagLine(): ?string;

    public function getLinkedInUrl(): ?string;

    public function enableBlogPosts(): bool;

    public function getData(): array;

}

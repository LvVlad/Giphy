<?php declare(strict_types=1);

namespace App\Models;

class Gif
{
    private string $title;
    private string $originalUrl;

    public function __construct(string $title, string $originalUrl)
    {
        $this->title = $title;
        $this->originalUrl = $originalUrl;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }
}
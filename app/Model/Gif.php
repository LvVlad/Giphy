<?php declare(strict_types=1);

namespace App\Model;

class Gif
{
    private string $title;
    private string $uploader;
    private string $originalUrl;

    public function __construct(string $title, string $uploader, string $originalUrl)
    {
        $this->title = $title;
        $this->uploader = $uploader;
        $this->originalUrl = $originalUrl;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUploader(): string
    {
        return $this->uploader;
    }

    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }
}
<?php

namespace App;

class View
{
    private string $path;
    private array $info;

    public function __construct(string $path, array $info)
    {
        $this->path = $path;
        $this->info = $info;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getInfo(): array
    {
        return $this->info;
    }
}
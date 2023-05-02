<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;
use App\View;

class Controller
{
    private ApiClient $client;

    public function __construct(int $limit)
    {
        $this->client = new ApiClient($limit);
    }

    public function trending(): View
    {
        $gifs = $this->client->showTrending();
        return new View('trending', ['gifs' => $gifs]);
    }

    public function search(): View
    {
        $query = $_GET['q'] ?? '';
        $gifs = $this->client->search($query);
        return new View('search', ['gifs' => $gifs]);
    }
}
<?php declare(strict_types=1);

namespace App;

use App\Models\Gif;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;
    private int $limit;
    private string $apiKey;
    private string $rating;
    private array $info;

    public function __construct(int $limit = 5)
    {
        $this->client = new Client(['base_uri' => 'http://api.giphy.com/v1/gifs/']);
        $this->limit = $limit;
        $this->apiKey = $_ENV['API_KEY'];
        $this->rating = 'g';
        $this->info = [
            'query' => [
                'api_key' => $this->apiKey,
                'limit' => $this->limit,
                'rating' => $this->rating
            ]];
    }

    public function showTrending(): array
    {
        $response = $this->client->request('GET','trending?', $this->info);
        return $this->getGifs($response);
    }

    public function showRandom(): array
    {
        $response = $this->client->request('GET', 'random?', $this->info);
        return $this->getGifs($response);
    }

    public function search(string $input)
    {
        $searchInfo = $this->info;
        $searchInfo['query']['q'] = $input;
        $response = $this->client->request('GET', 'search?', $searchInfo);
        return $this->getGifs($response);
    }

    private function getGifs(object $response): array
    {
        $gifsData = json_decode($response->getBody()->getContents())->data;
        $gifsToDisplay = [];

        foreach ($gifsData as $giphy)
        {
            $gifsToDisplay[] = $this->createModel($giphy);
        }
        return $gifsToDisplay;
    }

    private function createModel(\stdClass $giphy): Gif
    {
        return new Gif(
            $giphy->title,
            $giphy->images->original->url
        );
    }
}
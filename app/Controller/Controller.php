<?php declare(strict_types=1);

namespace App\Controller;

use App\ApiClient;
use Twig\Environment;

class Controller
{
    private ApiClient $client;
    private Environment $twig;

    public function __construct(int $limit, Environment $twig)
    {
        $this->client = new ApiClient($limit);
        $this->twig = $twig;
    }

    public function trending()
    {
        $gifs = $this->client->showTrending();
        return $this->twig->render('trending.twig', ['gifs' => $gifs]);
    }

    public function random()
    {
        $gifs = $this->client->showRandom();
        return $this->twig->render('random.twig', ['gifs' => $gifs]);
    }

    public function home()
    {
        $gifs = $this->client->showRandom();
        return $this->twig->render('home.twig', ['gifs' => $gifs]);
    }

    public function search() //placeholder (need to add user input search)
    {
        $gifs = $this->client->search('coding');
        return $this->twig->render('search.twig', ['gifs' => $gifs]);
    }
}
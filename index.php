<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\ApiClient;
use App\Controller\Controller;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$loader = new FilesystemLoader('app/View');
$twig = new Environment($loader);

$test = new ApiClient();
$controller = new Controller(5, $twig);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/home', [Controller::class, 'home']);
    $r->addRoute('GET', '/random', [Controller::class, 'random']);
    $r->addRoute('GET', '/trending', [Controller::class, 'trending']);
    $r->addRoute('GET', '/search', [Controller::class, 'search']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controllerBase, $method] = $handler;
        $controller = new $controllerBase(5, $twig);
        $response = $controller->{$method}();
        break;
}
<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Config\Routes;
use App\Router\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__.'/../templates/');
$twig = new Environment($loader, ['debug' => true]);

$router = new Router($_GET['url'], $twig);

foreach (Routes::getRoutes() as $name => $route) {
    foreach ($route as $method => $params) {
        $router->$method($params['path'], $params['controller'].'#'.$params['method']);
    }
}

echo $router->run();

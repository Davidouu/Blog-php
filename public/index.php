<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Config\Routes;
use App\Http\Request;
use App\Http\Session;
use App\Router\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$session = new Session();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../', '.env.local');
$dotenv->load();

$loader = new FilesystemLoader(__DIR__.'/../templates/');
$twig = new Environment($loader, ['debug' => true]);

$twig->addGlobal('session', $session);

$request = new Request();

$router = new Router($request->getParam('GET', 'url'), $twig, $request, $session);

foreach (Routes::getRoutes() as $name => $route) {
    foreach ($route as $method => $params) {
        $router->$method($params['path'], "{$params['controller']}->{$params['method']}");
    }
}

echo $router->run();

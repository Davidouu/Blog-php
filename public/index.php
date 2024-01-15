<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Config\Routes;
use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Router\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$session = new Session();

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../', '.env.local');
$dotenv->load();

// Twig
$loader = new FilesystemLoader(__DIR__.'/../templates/');
$twig = new Environment($loader, ['debug' => true]);

// Add session var to twig
$twig->addGlobal('session', $session);

$request = new Request();
$files = new File();

// Router
$router = new Router($request->getParam('GET', 'url'), $twig, $request, $session, $files);

foreach (Routes::getRoutes() as $name => $route) {
    foreach ($route as $method => $params) {
        $router->$method($params['path'], "{$params['controller']}->{$params['method']}");
    }
}

echo $router->run();

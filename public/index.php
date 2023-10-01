<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Router\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__.'/../templates/');
$twig = new Environment($loader, ['debug' => true]);

$router = new Router($_GET['url'], $twig);

$router->get('/', 'HomeController#index');

echo $router->run();

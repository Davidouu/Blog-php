<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Router\Router;

$router = new Router($_GET['url']);

$router->get('/', 'HomeController#index');

echo $router->run();

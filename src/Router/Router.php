<?php

namespace App\Router;

class Router
{
    private $url;
    private $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    public function get($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    public function run()
    {

        foreach ($this->routes['GET'] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
    }
}

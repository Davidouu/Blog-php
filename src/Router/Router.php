<?php

namespace App\Router;

use Twig\Environment;

class Router
{
    private string $url;

    private $routes = [];

    public function __construct(
        // private string $url,
        $url,
        private Environment $twig,
    ) {
        $this->url = trim($url, '/');
    }

    /**
     * Add a GET route.
     */
    public function get($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    /**
     * Run the router.
     */
    public function run()
    {

        foreach ($this->routes['GET'] as $route) {
            if ($route->match($this->url)) {

                return $route->call($this->twig);
            }
        }
    }
}

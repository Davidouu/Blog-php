<?php

namespace App\Router;

use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use Twig\Environment;

class Router
{
    private $routes = [];

    public function __construct(
        private string $url,
        private Environment $twig,
        private Request $request,
        private Session $session,
        private File $files
    ) {
        $this->url = trim($url, '/');
    }

    /**
     * Add a GET route.
     * @param string $path
     * @param \Closure|string $callable
     * @return void
     */
    public function get($path, $callable): void
    {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    /**
    * Add a POST route.
    * @param string $path
    * @param \Closure|string $callable
    * @return void
    */
    public function post($path, $callable): void
    {
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
    }

    /**
     * Run the router.
     * @return mixed
     */
    public function run(): mixed
    {
        if (! isset($this->routes[$this->request->getMethod()])) {
            header('HTTP/1.0 404 Not Found');

            return $this->twig->render('404.html.twig');
        }

        foreach ($this->routes[$this->request->getMethod()] as $route) {
            if ($route->match($this->url)) {

                return $route->call($this->twig, $this->request, $this->session, $this->files);
            }
        }
        header('HTTP/1.0 404 Not Found');

        return $this->twig->render('404.html.twig');
    }
}

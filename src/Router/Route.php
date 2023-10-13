<?php

namespace App\Router;

use Twig\Environment;

class Route
{
    private $path;

    private $callable;

    public function __construct($path, $callable)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    /**
     * Check if the route matches the URL.
     */
    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if (! preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);

        return true;
    }

    /**
     * Call the controller method.
     */
    public function call(Environment $twig)
    {
        if (is_string($this->callable)) {
            $params = explode('#', $this->callable);
            $controller = 'App\\Controller\\'.$params[0];
            $controller = new $controller($twig);

            return call_user_func_array([$controller, $params[1]], []);
        }

        return call_user_func_array($this->callable, []);
    }
}
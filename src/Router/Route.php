<?php

namespace App\Router;

use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use Twig\Environment;

class Route
{
    private array $matches = [];

    private array $params = [];

    private \Closure|string $callable;

    private $path;

    public function __construct(string $path, string $callable)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    /**
     * Check if the route matches the URL.
     * @param string $url
     * @return bool
     */
    public function match($url): bool
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^{$path}$#i";
        if (! preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;

        return true;
    }

    /**
     * Call the controller method.
     * @param Environment $twig
     * @param Request $request
     * @param Session $session
     * @param File $files
     * @return mixed
     */
    public function call(Environment $twig, Request $request, Session $session, File $files): mixed
    {
        if (is_string($this->callable)) {
            $params = explode('->', $this->callable);
            $controller = 'App\\Controller\\'.$params[0];
            $controller = new $controller($twig, $request, $session, $files);

            return call_user_func_array([$controller, $params[1]], $this->matches);
        }

        return call_user_func_array($this->callable, $this->matches);
    }

    private function paramMatch(array $match): string
    {
        if (isset($this->params[$match[1]])) {
            return '('.$this->params[$match[1]].')';
        }

        return '([^/]+)';
    }
}

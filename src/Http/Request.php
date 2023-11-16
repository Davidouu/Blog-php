<?php

namespace App\Http;

class Request
{
    private array $params;

    public function __construct()
    {
        $this->params = [
            'GET' => $_GET,
            'POST' => $_POST,
        ];
    }

    // Retourne tous les paramètres de la requête
    public function getParams(string $method): array
    {
        return $this->params[$method];
    }

    // Retourne un paramètre de la requête
    public function getParam(string $method, string $name): string
    {
        return $this->params[$method][$name] ?? null;
    }

    // Ajoute un paramètre à la requête
    public function setParam(string $method, string $name): void
    {
        $this->params[$method][$name] = $name;
    }

    // Retourne la méthode HTTP de la requête
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}

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

    /**
     * Retourne tous les paramètres de la requête
     * @param string $method
     * @return array
     */
    public function getParams(string $method): array
    {
        return $this->params[$method];
    }

    /**
     * Retourne un paramètre de la requête
     * @param string $method
     * @param string $name
     * @return string
     */
    public function getParam(string $method, string $name): string
    {
        return $this->params[$method][$name] ?? null;
    }

    /**
     * Ajoute un paramètre à la requête
     * @param string $method
     * @param string $name
     * @return void
     */
    public function setParam(string $method, string $name): void
    {
        $this->params[$method][$name] = $name;
    }

    /**
     * Retourne la méthode HTTP de la requête
     * @return string
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}

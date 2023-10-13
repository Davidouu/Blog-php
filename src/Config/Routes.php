<?php

namespace App\Config;

class Routes
{
    public static function getRoutes(): array
    {
        return [
            'home' => [
                'GET' => [
                    'path' => '/',
                    'controller' => 'HomeController',
                    'method' => 'index',
                ],
            ],
        ];
    }
}

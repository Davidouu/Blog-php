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

            'articles' => [
                'GET' => [
                    'path' => '/articles',
                    'controller' => 'ArticleController',
                    'method' => 'index',
                ],
            ],

            'register' => [
                'GET' => [
                    'path' => '/inscription',
                    'controller' => 'UserController',
                    'method' => 'register',
                ],
                'POST' => [
                    'path' => '/inscription',
                    'controller' => 'UserController',
                    'method' => 'register',
                ],
            ],

            'confirmationAccount' => [
                'GET' => [
                    'path' => '/confirmation-compte/:id-:token',
                    'controller' => 'UserController',
                    'method' => 'confirmationAccount',
                ],
            ],

            'login' => [
                'GET' => [
                    'path' => '/connexion',
                    'controller' => 'UserController',
                    'method' => 'login',
                ],
                'POST' => [
                    'path' => '/connexion',
                    'controller' => 'UserController',
                    'method' => 'login',
                ],
            ],
        ];
    }
}

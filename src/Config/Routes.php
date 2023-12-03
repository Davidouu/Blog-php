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
                'POST' => [
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

            'article' => [
                'GET' => [
                    'path' => '/article/:id/:slug',
                    'controller' => 'ArticleController',
                    'method' => 'show',
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

            'logout' => [
                'GET' => [
                    'path' => '/deconnexion',
                    'controller' => 'UserController',
                    'method' => 'logout',
                ],
            ],

            'admin' => [
                'GET' => [
                    'path' => '/admin',
                    'controller' => 'AdminController',
                    'method' => 'index',
                ],
            ],
        ];
    }
}

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

            'newArticle' => [
                'GET' => [
                    'path' => '/admin/article/nouveau',
                    'controller' => 'ArticleController',
                    'method' => 'newArticle',
                ],
                'POST' => [
                    'path' => '/admin/article/nouveau',
                    'controller' => 'ArticleController',
                    'method' => 'newArticle',
                ],
            ],

            'editArticle' => [
                'GET' => [
                    'path' => '/admin/article/:id/edit',
                    'controller' => 'ArticleController',
                    'method' => 'editArticle',
                ],
                'POST' => [
                    'path' => '/admin/article/:id/edit',
                    'controller' => 'ArticleController',
                    'method' => 'editArticle',
                ],
            ],

            'deleteArticle' => [
                'GET' => [
                    'path' => '/admin/article/:id/delete',
                    'controller' => 'ArticleController',
                    'method' => 'deleteArticle',
                ],
            ],

            'validetaArticle' => [
                'GET' => [
                    'path' => '/admin/article/:id/validate',
                    'controller' => 'ArticleController',
                    'method' => 'validetaArticle',
                ],
            ],

            'unvalidetaArticle' => [
                'GET' => [
                    'path' => '/admin/article/:id/unvalidate',
                    'controller' => 'ArticleController',
                    'method' => 'unvalidetaArticle',
                ],
            ],

            'newCategory' => [
                'GET' => [
                    'path' => '/admin/categorie/new',
                    'controller' => 'CategoryController',
                    'method' => 'newCategory',
                ],
                'POST' => [
                    'path' => '/admin/categorie/new',
                    'controller' => 'CategoryController',
                    'method' => 'newCategory',
                ],
            ],

            'editCategory' => [
                'GET' => [
                    'path' => '/admin/categorie/:id/edit',
                    'controller' => 'CategoryController',
                    'method' => 'editCategory',
                ],
                'POST' => [
                    'path' => '/admin/categorie/:id/edit',
                    'controller' => 'CategoryController',
                    'method' => 'editCategory',
                ],
            ],

            'deleteCategory' => [
                'GET' => [
                    'path' => '/admin/categorie/:id/delete',
                    'controller' => 'CategoryController',
                    'method' => 'deleteCategory',
                ],
            ],
        ];
    }
}

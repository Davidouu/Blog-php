<?php

namespace App\Controller;

class AdminController extends AbstractController
{
    public function index(): string
    {
        return $this->render('admin/index.html.twig');
    }
}

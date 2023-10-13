<?php

namespace App\Controller;

use Twig\Environment;

class HomeController extends AbstractController
{
    public function __construct(Environment $twig)
    {
        parent::__construct($twig);
    }

    /*
    * @return string
    */
    public function index()
    {
        return $this->render('index.html.twig', [
            'title' => 'Home',
        ]);
    }
}

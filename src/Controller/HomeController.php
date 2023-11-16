<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Session;
use Twig\Environment;

class HomeController extends AbstractController
{
    public function __construct(Environment $twig, Request $request, Session $session)
    {
        parent::__construct($twig, $request, $session);
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

<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Session;
use App\Repository\ArticlesRepository;
use Twig\Environment;

class ArticleController extends AbstractController
{
    private ArticlesRepository $articlesRepository;

    public function __construct(Environment $twig, Request $request, Session $session)
    {
        $this->articlesRepository = new ArticlesRepository();
        parent::__construct($twig, $request, $session);
    }

    /*
    * @return string
    */
    public function index()
    {
        $articles = $this->articlesRepository->getAllArticles(['column' => 'updateDate', 'order' => 'DESC'], null);

        return $this->render('articles.html.twig', ['articles' => $articles]);
    }
}

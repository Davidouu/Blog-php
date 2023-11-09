<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Twig\Environment;

class ArticleController extends AbstractController
{
    private ArticlesRepository $articlesRepository;

    public function __construct(Environment $twig)
    {
        $this->articlesRepository = new ArticlesRepository();
        parent::__construct($twig);
    }

    /*
    * @return string
    */
    public function index()
    {
        $articles = $this->articlesRepository->getAllArticles(null, null);

        return $this->render('articles.html.twig', ['articles' => $articles]);
    }
}

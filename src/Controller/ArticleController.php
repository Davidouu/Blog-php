<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Session;
use App\Repository\ArticlesRepository;
use App\Repository\CategoryRepository;
use Twig\Environment;

class ArticleController extends AbstractController
{
    private ArticlesRepository $articlesRepository;

    private CategoryRepository $categoryRepository;

    public function __construct(Environment $twig, Request $request, Session $session)
    {
        $this->articlesRepository = new ArticlesRepository();
        $this->categoryRepository = new CategoryRepository();
        parent::__construct($twig, $request, $session);
    }

    /*
    * @return string
    */
    public function index(): string
    {
        $articles = $this->articlesRepository->getAllArticles(['column' => 'updateDate', 'order' => 'DESC'], null);

        return $this->render('articles.html.twig', ['articles' => $articles]);
    }

    /*
    * @param int $id
    * @param string $slug
    * @return string
    */
    public function show(int $id, string $slug): string
    {
        $article = $this->articlesRepository->getArticleById($id);

        if ($article === null) {
            $this->redirect('/articles');
        }

        return $this->render('article.html.twig', ['article' => $article]);
    }

    // New article
    public function newArticle()
    {
        if (! empty($this->request->getParams('POST'))) {
            dd($this->request->getParams('POST'));
            $this->articlesRepository->createArticle($this->request->getParams('POST'));
            $this->redirect('/articles');
        }

        return $this->render('admin/new.html.twig', ['categories' => $this->categoryRepository->getAllCategories()]);
    }
}

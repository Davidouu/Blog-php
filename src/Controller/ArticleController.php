<?php

namespace App\Controller;

use App\Entity\Article;
use App\Helpers;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\ArticlesRepository;
use App\Repository\CategoryRepository;
use App\Validator\Validator;
use Twig\Environment;

class ArticleController extends AbstractController
{
    private ArticlesRepository $articlesRepository;

    private CategoryRepository $categoryRepository;

    private Hydrator $hydrator;

    private Helpers $helpers;

    public function __construct(Environment $twig, Request $request, Session $session)
    {
        $this->articlesRepository = new ArticlesRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->hydrator = new Hydrator();
        $this->helpers = new Helpers();
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
            // Validate data

            $article = new Article();

            $validator = new Validator();
            $errors = $validator->validate($article, $this->request->getParams('POST'));

            if (count($errors) > 0) {
                return $this->render('admin/new.html.twig', ['errors' => $errors, 'post' => $this->request->getParams('POST'), 'categories' => $this->categoryRepository->getAllCategories()]);
            }

            $article->setAuthor($this->session->get('user'));
            $article->setPromote(array_key_exists('promote', $this->request->getParams('POST')) ? true : false);

            // Upload thumbnail

            $article->setThumbnailUrl('/assets/img/article-test.jpg');

            $this->hydrator->hydrate($article, $this->request->getParams('POST'));

            $article->setSlug($this->helpers->slugify($article->getTitle()));
            $article->setIsValidated(false);

            if ($this->request->getParams('POST')['idCategory'] !== '') {
                $article->setCategory($this->categoryRepository->getCategoryById((int) $this->request->getParams('POST')['idCategory']));
            } else {
                $article->setCategory($this->categoryRepository->getCategoryById(1));
            }

            // Set thumbnailUrl

            if (! $this->articlesRepository->createArticle($article)) {
                return $this->render('admin/new.html.twig', ['message' => 'Une erreur est survenue lors de l\'ajout de l\'article !', 'categories' => $this->categoryRepository->getAllCategories()]);
            }

            $this->redirect('/admin');

        }

        return $this->render('admin/new.html.twig', ['categories' => $this->categoryRepository->getAllCategories()]);
    }
}

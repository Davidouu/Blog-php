<?php

namespace App\Controller;

use App\Entity\Article;
use App\FileUploader;
use App\Helpers;
use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\ArticlesRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Validator\Validator;
use Twig\Environment;

class ArticleController extends AbstractController
{
    private ArticlesRepository $articlesRepository;

    private CategoryRepository $categoryRepository;

    private UserRepository $userRepository;

    private CommentRepository $commentRepository;

    private Hydrator $hydrator;

    private Helpers $helpers;

    private FileUploader $fileUploader;

    public function __construct(Environment $twig, Request $request, Session $session, File $files)
    {
        $this->articlesRepository = new ArticlesRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->userRepository = new UserRepository();
        $this->commentRepository = new CommentRepository();
        $this->hydrator = new Hydrator();
        $this->helpers = new Helpers();
        $this->fileUploader = new FileUploader(['png', 'jpeg', 'jpg']);
        parent::__construct($twig, $request, $session, $files);
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
        $comments = $this->commentRepository->getCommentsByArticleId($id);

        if ($article === null) {
            $this->redirect('/articles');
        }

        return $this->render('article.html.twig', ['article' => $article, 'comments' => $comments]);
    }

    /*
    * @return string
    */
    public function newArticle(): string
    {
        if (! empty($this->request->getParams('POST'))) {
            $article = new Article();

            $upload = $this->fileUploader->upload($this->files->get('thumbnail'));

            if (is_array($upload)) {
                return $this->render('admin/new.html.twig', ['errors' => $upload, 'post' => $this->request->getParams('POST'), 'categories' => $this->categoryRepository->getAllCategories()]);
            }

            $article->setThumbnailUrl($upload);

            $validator = new Validator();
            $errors = $validator->validate($article, $this->request->getParams('POST'));

            if (count($errors) > 0) {
                return $this->render('admin/new.html.twig', ['errors' => $errors, 'post' => $this->request->getParams('POST'), 'categories' => $this->categoryRepository->getAllCategories()]);
            }

            $article->setAuthor($this->session->get('user'));
            $article->setPromote(array_key_exists('promote', $this->request->getParams('POST')) ? true : false);

            $this->hydrator->hydrate($article, $this->request->getParams('POST'));
            
            $article->setSlug($this->helpers->slugify($article->getTitle()));
            $article->setIsValidated(false);
            
            if ($this->request->getParams('POST')['idCategory'] !== null) {
                $article->setCategory($this->categoryRepository->getCategoryById((int) $this->request->getParams('POST')['idCategory']));
            } else {
                $article->setCategory($this->categoryRepository->getCategoryById(1));
            }


            if (! $this->articlesRepository->createArticle($article)) {
                return $this->render('admin/new.html.twig', ['message' => 'Une erreur est survenue lors de l\'ajout de l\'article !', 'categories' => $this->categoryRepository->getAllCategories()]);
            }

            $this->redirect('/admin');

        }

        return $this->render('admin/new.html.twig', ['categories' => $this->categoryRepository->getAllCategories()]);
    }

    /*
    * @param int $id
    * @param string $slug
    * @return string
    */
    public function editArticle(int $id): string
    {
        $thisArticle = $this->articlesRepository->getArticleById($id);

        if (! empty($this->request->getParams('POST'))) {

            $article = new Article();

            $article->setId($thisArticle->getId());


            if (! $this->request->getParams('POST')['thumbnail']) {
                $article->setThumbnailUrl($thisArticle->getThumbnailUrl());
            } else {
                $upload = $this->fileUploader->upload($this->files->get('thumbnail'));

                if (is_array($upload)) {
                    return $this->render('admin/new.html.twig', ['errors' => $upload, 'post' => $this->request->getParams('POST'), 'categories' => $this->categoryRepository->getAllCategories()]);
                }

                $article->setThumbnailUrl($upload);
            }

            $validator = new Validator();
            $errors = $validator->validate($article, $this->request->getParams('POST'));

            if (count($errors) > 0) {
                return $this->render('admin/edit.html.twig', ['errors' => $errors, 'post' => $this->request->getParams('POST'), 'categories' => $this->categoryRepository->getAllCategories()]);
            }

            $article->setAuthor($this->userRepository->getUserById($thisArticle->getAuthor()->getUserId()));
            $article->setPromote(array_key_exists('promote', $this->request->getParams('POST')) ? true : false);

            $this->hydrator->hydrate($article, $this->request->getParams('POST'));

            $article->setSlug($this->helpers->slugify($article->getTitle()));
            $article->setIsValidated(false);
            $article->setUpdateDate(new \DateTime('now'));

            if ($this->request->getParams('POST')['idCategory'] !== '') {
                $article->setCategory($this->categoryRepository->getCategoryById((int) $this->request->getParams('POST')['idCategory']));
            } else {
                $article->setCategory($this->categoryRepository->getCategoryById(1));
            }

            if (! $this->articlesRepository->updateArticle($article)) {
                return $this->render('admin/new.html.twig', ['message' => 'Une erreur est survenue lors de l\'ajout de l\'article !', 'categories' => $this->categoryRepository->getAllCategories()]);
            }

            $this->redirect('/admin');

        }

        return $this->render('admin/edit.html.twig', ['categories' => $this->categoryRepository->getAllCategories(), 'article' => $thisArticle, 'type' => 'modification']);
    }

    /*
    * @param int $id
    * @return void
    */
    public function deleteArticle(int $id): void
    {
        $this->articlesRepository->deleteArticle($id);
        $this->redirect('/admin');
    }

    /*
    * @param int $id
    * @return void
    */
    public function validetaArticle(int $id): void
    {
        $this->articlesRepository->validateArticle($id);
        $this->redirect('/admin');
    }

    /*
    * @param int $id
    * @return void
    */
    public function unvalidetaArticle(int $id): void
    {
        $this->articlesRepository->unvalidateArticle($id);
        $this->redirect('/admin');
    }
}

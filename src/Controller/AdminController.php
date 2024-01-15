<?php

namespace App\Controller;

use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Repository\ArticlesRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use Twig\Environment;

class AdminController extends AbstractController
{
    private ArticlesRepository $articlesRepository;

    private CategoryRepository $categoryRepository;

    private CommentRepository $commentRepository;

    public function __construct(
        Environment $twig,
        Request $request,
        Session $session,
        File $files
    ) {
        $this->articlesRepository = new ArticlesRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->commentRepository = new CommentRepository();

        parent::__construct($twig, $request, $session, $files);
    }

    /**
    * Display the admin dashboard.
    * @return string
    */
    public function index(): string
    {
        $articles = $this->articlesRepository->getAllArticles(['column' => 'updateDate', 'order' => 'DESC'], null);
        $categories = $this->categoryRepository->getAllCategories();
        $comments = $this->commentRepository->getAllComments(null);

        return $this->render('admin/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'comments' => $comments
        ]);
    }
}

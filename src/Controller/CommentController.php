<?php

namespace App\Controller;

use App\Entity\Comment;
use App\helpers;
use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Validator\Validator;
use Twig\Environment;
use App\Repository\ArticlesRepository;
use App\Repository\CommentRepository;

class CommentController extends AbstractController
{

    private Hydrator $hydrator;

    private helpers $helpers;

    private ArticlesRepository $articlesRepository;

    private CommentRepository $commentRepository;

    public function __construct(Environment $twig, Request $request, Session $session, File $files)
    {
        $this->hydrator = new Hydrator();
        $this->helpers = new helpers();
        $this->articlesRepository = new ArticlesRepository();
        $this->commentRepository = new CommentRepository();
        parent::__construct($twig, $request, $session, $files);
    }

    public function postComment(int $id, string $slug)
    {
        $article = $this->articlesRepository->getArticleById($id);

        if (! empty($this->request->getParams('POST'))) {
            $comment = new Comment();

            $validator = new Validator();
            $errors = $validator->validate($comment, $this->request->getParams('POST'));

            if (count($errors) > 0) {
                return $this->render('article.html.twig', ['errors' => $errors, 'article' => $article]);
            }

            $this->hydrator->hydrate($comment, $this->request->getParams('POST'));

            $comment->setAuthor($this->session->get('user'));
            $comment->setArticle($article);
            $comment->setIsValidated(false);

            if (!$this->commentRepository->addComment($comment)) {
                return $this->render('article.html.twig', ['message' => 'Il y a eu une erreur lors de la création du commenatire', 'article' => $article]);
            }
        
            return $this->render('article.html.twig', ['message' => 'Votre commentaire a bien été posté, il va désormais être valider par un modérateur.', 'article' => $article]);
        }

        $this->redirect('/article/' . $id . '/' . $slug, ['article' => $article]);
    }
}
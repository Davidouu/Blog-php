<?php

namespace App\Controller;

use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Repository\ArticlesRepository;
use Twig\Environment;

class HomeController extends AbstractController
{
    private ArticlesRepository $articlesRepository;

    public function __construct(
        Environment $twig,
        Request $request,
        Session $session,
        File $files
    ) {
        $this->articlesRepository = new ArticlesRepository();

        parent::__construct($twig, $request, $session, $files);
    }

    /**
     * Display all articles
    * @return string
    */
    public function index()
    {
        if (empty($this->request->getParams('POST'))) {
            $articles = $this->articlesRepository->getAllArticles(null);

            return $this->render('index.html.twig', [
                'title' => 'Home',
                'articles' => $articles,
            ]);
        }

        foreach ($this->request->getParams('POST') as $key => $value) {
            if (empty($value)) {
                $errors[$key] = 'Le champ ne doit pas être vide';
            }

            if ($key === 'email' && ! filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = 'Le champ doit être un email valide';
            }
        }

        if (! empty($errors)) {
            return $this->render('index.html.twig', [
                'title' => 'Home',
                'errors' => $errors,
            ]);
        }

        $name = $this->request->getParams('POST')['name'];
        $email = $this->request->getParams('POST')['email'];
        $number = $this->request->getParams('POST')['phone'];
        $message = $this->request->getParams('POST')['message'];

        $mail = mail(
            'ddidnik@hotmail.fr',
            'Demande de contact.',
            "Vous avez reçu un mail depuis le formulaire de contact.<br><br>Nom : $name<br>Email : $email<br>Numéro : $number<br>Message : $message"
        );

        if ($mail) {
            $this->render('index.html.twig', [
                'title' => 'Home',
                'message' => 'Votre message a bien été envoyé',
            ]);
        } else {
            $this->render('index.html.twig', [
                'title' => 'Home',
                'message' => 'Il y a eu une erreur lors de l\'envoi du message',
            ]);
        }
    }
}

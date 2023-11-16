<?php

namespace App\Controller;

use App\Entity\User;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\UserRepository;
use App\TokenGenerator;
use App\Validator\Validator;
use Twig\Environment;

class UserController extends AbstractController
{
    private UserRepository $UserRepository;

    private Hydrator $hydrator;

    public function __construct(Environment $twig, Request $request, Session $session)
    {
        $this->UserRepository = new UserRepository();
        $this->hydrator = new Hydrator();
        parent::__construct($twig, $request, $session);
    }

    // Register new user
    public function register(): string
    {

        if (! empty($this->request->getParams('POST'))) {
            $user = new User();

            $validator = new Validator();
            $errors = $validator->validate($user, $this->request->getParams('POST'));

            if (count($errors) > 0) {
                return $this->render('register.html.twig', ['errors' => $errors, 'post' => $this->request->getParams('POST')]);
            }

            $this->hydrator->hydrate($user, $this->request->getParams('POST'));
            $user->setPassword(password_hash($this->request->getParam('POST', 'password'), PASSWORD_DEFAULT));

            $token = TokenGenerator::generateToken();
            $user->setConfirmationToken($token);

            if ($this->UserRepository->getUserByEmail($user)) {
                return $this->render('register.html.twig', ['message' => 'Un compte existe déjà avec cette adresse mail !']);
            }

            $userId = $this->UserRepository->addUser($user);

            if ($userId) {
                $user->setId($userId);

                mail(
                    $user->getEmail(),
                    'Confirmation de votre compte',
                    "Pour confirmer cotre compte, veuillez cliquer sur le lien suivant.\n{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/confirmation-compte/$userId-$token"
                );

                return $this->render('register.html.twig', ['message' => 'Un mail de confirmation a été envoyé '.$user->getEmail().' !']);

            }
        }

        return $this->render('register.html.twig');
    }

    // Confirm user account
    public function confirmationAccount(string $id, string $token): ?string
    {
        $user = new User();
        $user->setId((int) $id);
        $user->setConfirmationToken($token);

        $user = $this->UserRepository->getUserById($user);

        if ($user) {
            $user->setConfirmationToken(null);
            $user->setValidateAt(new \DateTime(date('Y-m-d H:i:s')));

            $this->UserRepository->updateUser($user);

            $this->redirect('/connexion');
        }

        return $this->render('register.html.twig', ['message' => 'Votre compte n\'a pas pu être confirmé !']);
    }

    // Login user
    public function login(): string
    {
        // If not connected redirect to register
        if ($this->session->get('user') === null) {
            $this->redirect('/inscription');
        }

        return $this->render('connexion.html.twig');
    }
}

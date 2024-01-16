<?php

namespace App\Controller;

use App\Entity\User;
use App\Http\File;
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

    public function __construct(Environment $twig, Request $request, Session $session, File $files)
    {
        $this->UserRepository = new UserRepository();
        $this->hydrator = new Hydrator();
        parent::__construct($twig, $request, $session, $files);
    }

    /**
     * Display all users
    * Register user
    * @return string
    */
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
            $user->setRole('user');
            
            if ($this->UserRepository->getUserByEmail($user)) {
                return $this->render('register.html.twig', ['message' => 'Un compte existe déjà avec cette adresse mail !']);
            }
            
            $userId = $this->UserRepository->addUser($user);

            if ($userId) {
                $user->setUserId($userId);

                mail(
                    $user->getEmail(),
                    'Confirmation de votre compte',
                    "Pour confirmer cotre compte, veuillez cliquer sur le lien suivant.\n{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/confirmation-compte/$userId/$token"
                );

                return $this->render('register.html.twig', ['message' => 'Un mail de confirmation a été envoyé '.$user->getEmail().' !']);

            }
        }

        return $this->render('register.html.twig');
    }

    /**
    * Confirmation account
    * @param string $id
    * @param string $token
    * @return string|null
    */
    public function confirmationAccount(string $id, string $token): ?string
    {
        $user = new User();
        $user->setUserId((int) $id);
        $user->setConfirmationToken($token);

        $user = $this->UserRepository->getUserById($user->getUserId());

        if ($user) {
            $user->setConfirmationToken(null);
            $user->setValidateAt(new \DateTime(date('Y-m-d H:i:s')));

            $this->UserRepository->updateUser($user);

            $this->redirect('/connexion');
        }

        return $this->render('register.html.twig', ['message' => 'Votre compte n\'a pas pu être confirmé !']);
    }

    /**
    * Login user
    * @return string
    */
    public function login(): string
    {
        // If connected redirect to index
        if ($this->session->get('user') !== null) {
            $this->redirect('/');
        }

        if (empty($this->request->getParams('POST'))) {
            return $this->render('connexion.html.twig');
        }
        
        $user = new User();
        $user->setEmail($this->request->getParam('POST', 'email'));
        $user->setPassword($this->request->getParam('POST', 'password'));

        // Si aucun utilisateur n'est trouvé avec l'email saisi on redirige vers la page de connexion
        if (! $this->UserRepository->getUserByEmail($user->setEmail($this->request->getParam('POST', 'email')))) {
            return $this->render('connexion.html.twig', ['message' => 'Aucun compte n\'est associé à cette adresse mail !']);
        }

        $user->setRole($this->UserRepository->getRole($user));
        $user->setUserId($this->UserRepository->getIdByMail($user));


        // Si l'utilisateur n'a pas confirmé son compte on redirige vers la page de connexion
        if (! $this->UserRepository->checkConfirmationAccount($user)) {
            return $this->render('connexion.html.twig', ['message' => 'Vous devez confirmer votre compte !']);
        }

        if ($user && password_verify($this->request->getParam('POST', 'password'), $this->UserRepository->getPasswordHash($user))) {
            $this->session->set('user', $user);
            $this->redirect('/');
        }

        return $this->render('connexion.html.twig', ['message' => 'Le mot de passe est incorrect !']);
    }

    /**
    * Logout user
    * @return void
    */
    public function logout(): void
    {
        $this->session->delete('user');
        $this->redirect('/');
    }

    /**
    * Profil page
    * @return string
    */
    public function profilPage(): string
    {
        if ($this->session->get('user') === null) {
            $this->redirect('/connexion');
        }

        $user = $this->session->get('user');

        $userData = $this->UserRepository->getUserById($user->getUserId());

        if (! empty($this->request->getParams('POST'))) {
            // L'utilisateur veur modifier son mot de passe
            if ($this->request->getParam('POST', 'password') !== $this->request->getParam('POST', 'passwordConfirm')) {
                return $this->render('profil.html.twig', ['message' => 'Les mots de passe ne correspondent pas !', 'user' => $userData]);
            }

            $validator = new Validator();
            $errors = $validator->validate($userData, $this->request->getParams('POST'));

            if (count($errors) > 0) {
                return $this->render('profil.html.twig', ['errors' => $errors, 'post' => $this->request->getParams('POST'), 'user' => $userData]);
            }

            $userData->setPassword(password_hash($this->request->getParam('POST', 'password'), PASSWORD_DEFAULT));

            $this->UserRepository->updateUser($userData);

            return $this->render('profil.html.twig', ['message' => 'Votre mot de passe a bien été modifié !', 'user' => $userData]);
        }

        return $this->render('profil.html.twig', ['user' => $userData]);
    }
}

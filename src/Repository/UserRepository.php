<?php

namespace App\Repository;

use App\DAL;
use App\Entity\User;
use App\Hydrator;

class UserRepository
{
    private DAL $dal;

    private Hydrator $hydrator;

    public function __construct()
    {
        $this->dal = new DAL();
        $this->hydrator = new Hydrator();
    }

    // Get one user by email
    public function getUserByEmail(User $user): bool|User
    {
        $sql = 'SELECT * FROM user WHERE email = :email';

        $this->dal->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->dal->fetchData('all');

        if (! empty($data)) {
            $user = new User();
            $this->hydrator->hydrate($user, $data);

            return $user;
        }

        return false;
    }

    // Get one user by id
    public function getUserById(User $user): bool|User
    {
        $sql = 'SELECT * FROM user WHERE id = :id';

        $this->dal->execute($sql, ['id' => $user->getId()]);
        $data = $this->dal->fetchData('one');

        if (! empty($data)) {
            $user = new User();
            $this->hydrator->hydrate($user, $data);

            return $user;
        }

        return false;
    }

    // Add new user
    public function addUser(User $user): int
    {
        $sql = 'INSERT INTO user (firstName, lastName, email, password, role, profilPictureUrl, confirmationToken) 
                VALUES (:firstName, :lastName, :email, :password, :role, :profilPictureUrl, :confirmationToken)';

        $this->dal->execute($sql, [
            'firstName' => $user->getFirstname(),
            'lastName' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole(),
            'profilPictureUrl' => $user->getProfilPictureUrl(),
            'confirmationToken' => $user->getConfirmationToken(),
        ]);

        return $this->dal->getLastInsertId();
    }

    // Update user
    public function updateUser(User $user): bool
    {
        $sql = 'UPDATE user 
                SET firstName = :firstName, lastName = :lastName, email = :email, 
                password = :password, role = :role, profilPictureUrl = :profilPictureUrl, 
                confirmationToken = :confirmationToken, validateAt = :validateAt 
                WHERE id = :id';

        return $this->dal->execute($sql, [
            'firstName' => $user->getFirstname(),
            'lastName' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole(),
            'profilPictureUrl' => $user->getProfilPictureUrl(),
            'confirmationToken' => $user->getConfirmationToken(),
            'validateAt' => $user->getValidateAt()->format('Y-m-d H:i:s'),
            'id' => $user->getId(),
        ]);
    }
}
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

    /*
    * @param User $user
    * @return bool|User
    */
    public function getUserByEmail(User $user): bool|User
    {
        $sql = 'SELECT * FROM user WHERE email = :email';

        $this->dal->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->dal->fetchData('all');

        if (! empty($data)) {
            $user = new User();
            $this->hydrator->hydrate($user, $data[0]);

            return $user;
        }

        return false;
    }

    /*
    * @param User $user
    * @return bool|User
    */
    public function getUserById(int $user): bool|User
    {
        $sql = 'SELECT * FROM user WHERE userId = :id';

        $this->dal->execute($sql, ['id' => $user]);
        $data = $this->dal->fetchData('one');

        if (! empty($data)) {
            $user = new User();
            $this->hydrator->hydrate($user, $data);

            return $user;
        }

        return false;
    }

    /*
    * @param User $user
    * @return int
    */
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

    /*
    * @param User $user
    * @return bool
    */
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

    /*
    * @param User $user
    * @return bool
    */
    public function checkConfirmationAccount(User $user): bool
    {
        $sql = 'SELECT validateAt FROM user WHERE email = :email';

        $this->dal->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->dal->fetchData('one');

        if (! empty($data) && $data['validateAt'] === null) {
            return false;
        }

        return true;
    }

    /*
    * @param User $user
    * @return bool|string
    */
    public function getPasswordHash(User $user): bool|string
    {
        $sql = 'SELECT password FROM user WHERE email = :email';

        $this->dal->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->dal->fetchData('one');

        if (! empty($data)) {
            return $data['password'];
        }

        return false;
    }

    /*
    * @param User $user
    * @return bool|string
    */
    public function getRole(User $user): bool|string
    {
        $sql = 'SELECT role FROM user WHERE email = :email';

        $this->dal->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->dal->fetchData('one');

        if (! empty($data)) {
            return $data['role'];
        }

        return false;
    }

    /*
    * @param User $user
    * @return int|bool
    */
    public function getIdByMail(User $user): bool|int
    {
        $sql = 'SELECT id FROM user WHERE email = :email';

        $this->dal->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->dal->fetchData('one');

        if (! empty($data)) {
            return $data['id'];
        }

        return false;
    }
}

<?php

namespace App\Entity;

use App\Validator\IsNotEmpty;
use App\Validator\IsValidEmail;
use App\Validator\IsValidPassword;

class User
{
    private int $userId;

    #[IsNotEmpty(message: 'Le prénom est obligatoire')]
    private string $firstName;

    #[IsNotEmpty(message: 'Le nom est obligatoire')]
    private string $lastName;

    #[IsNotEmpty(message: 'L\'email est obligatoire'), IsValidEmail(message: 'L\'email n\'est pas valide')]
    private string $email;

    #[IsValidPassword(message: 'Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule, un chiffre et un caractère spécial'), IsNotEmpty(message: 'Le mot de passe est obligatoire')]
    private string $password;

    private string $role;

    private ?string $confirmationToken;

    private \DateTime $validateAt;

    public function __construct()
    {
    }

    // Setters

    /**
     * @param int $id
     * @return self
     */
    public function setUserId(int $id): self
    {
        $this->userId = $id;

        return $this;
    }

    /**
     * @param string $firstName
     * @return self
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param string $lastname
     * @return self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastName = $lastname;

        return $this;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = strtolower($email);

        return $this;
    }

    /**
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param string $role
     * @return self
     */
    public function setRole(string $role): self
    {
        $this->role = strtolower($role);

        return $this;
    }

    /**
     * @param string $confirmationToken
     * @return self
     */
    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * @param \DateTime $validateAt
     * @return self
     */
    public function setValidateAt(?\DateTime $validateAt): self
    {
        $this->validateAt = $validateAt;

        return $this;
    }

    // Getters

    /**
     * @return int $id
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string $firstName
     */
    public function getFirstName(): string
    {
        return ucfirst($this->firstName);
    }

    /**
     * @return string $lastname
     */
    public function getLastname(): string
    {
        return strtoupper($this->lastName);
    }

    /**
     * @return string $email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string $password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return ?string $role
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @return ?string $confirmationToken
     */
    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    /**
     * @return ?\DateTime $validateAt
     */
    public function getValidateAt(): ?\DateTime
    {
        return $this->validateAt;
    }
}

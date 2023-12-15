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

    private string $profilPictureUrl;

    private ?string $confirmationToken;

    private \DateTime $validateAt;

    public function __construct()
    {
        $this->profilPictureUrl = 'images/user-placeholder.jpg';
    }

    // Setters
    public function setUserId(int $id): self
    {
        $this->userId = $id;

        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastName = $lastname;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = strtolower($email);

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setRole(string $role): self
    {
        $this->role = strtolower($role);

        return $this;
    }

    public function setProfilPictureUrl(string $profilPictureUrl): self
    {
        $this->profilPictureUrl = $profilPictureUrl;

        return $this;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function setValidateAt(?\DateTime $validateAt): self
    {
        $this->validateAt = $validateAt;

        return $this;
    }

    // Getters
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getFirstName(): string
    {
        return ucfirst($this->firstName);
    }

    public function getLastname(): string
    {
        return strtoupper($this->lastName);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function getProfilPictureUrl(): ?string
    {
        return $this->profilPictureUrl;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function getValidateAt(): ?\DateTime
    {
        return $this->validateAt;
    }
}

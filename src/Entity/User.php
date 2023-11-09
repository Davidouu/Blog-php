<?php

namespace App\Entity;

class User
{
    private int $id;

    private string $firstName;

    private string $lastname;

    private string $email;

    private string $password;

    private string $role;

    private string $profilPictureUrl;

    private ?string $confirmationToken;

    private \DateTime $validateAt;

    // Setters
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function setValidateAt(\DateTime $validateAt): self
    {
        $this->validateAt = $validateAt;

        return $this;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return ucfirst($this->firstName);
    }

    public function getLastname(): string
    {
        return strtoupper($this->lastname);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getProfilPictureUrl(): string
    {
        return $this->profilPictureUrl;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function getValidateAt(): \DateTime
    {
        return $this->validateAt;
    }
}

<?php

namespace App\Entity;

use App\Validator\IsNotEmpty;

class Comment
{
    private int $id;

    #[IsNotEmpty(message: 'Le contenue est obligatoire')]
    private string $content;

    private \DateTime $publishDate;

    private bool $isValidated;

    private User $author;

    private Article $article;

    // Setters

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setPublishDate(\DateTime $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function setIsValidated(bool $isValidated): self
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function setArticle(Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getPublishDate(): \DateTime
    {
        return $this->publishDate;
    }

    public function getIsValidated(): bool
    {
        return $this->isValidated;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }
}
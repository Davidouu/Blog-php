<?php

namespace App\Entity;

use App\Validator\IsNotEmpty;

class Comment
{
    private int $commentId;

    #[IsNotEmpty(message: 'Le contenue est obligatoire')]
    private string $commentContent;

    private \DateTime $publishDate;

    private bool $isValidated;

    private User $author;

    private Article $article;

    // Setters

    public function setCommentId(int $id): self
    {
        $this->commentId = $id;

        return $this;
    }

    public function setCommentContent(string $content): self
    {
        $this->commentContent = $content;

        return $this;
    }

    public function setPublishDate(\DateTime $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function setIsCommentValidated(bool $isValidated): self
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

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function getCommentContent(): string
    {
        return $this->commentContent;
    }

    public function getPublishDate(): \DateTime
    {
        return $this->publishDate;
    }

    public function getIsCommentValidated(): bool
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
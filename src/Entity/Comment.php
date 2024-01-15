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

    /**
     * @param int $id
     * @return self
     */
    public function setCommentId(int $id): self
    {
        $this->commentId = $id;

        return $this;
    }

    /**
     * @param string $content
     * @return self
     */
    public function setCommentContent(string $content): self
    {
        $this->commentContent = $content;

        return $this;
    }

    /**
     * @param \DateTime $publishDate
     * @return self
     */
    public function setPublishDate(\DateTime $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * @param bool $isValidated
     * @return self
     */
    public function setIsCommentValidated(bool $isValidated): self
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    /**
     * @param User $author
     * @return self
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @param Article $article
     * @return self
     */
    public function setArticle(Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    // Getters

    /**
     * @return int $id
     */
    public function getCommentId(): int
    {
        return $this->commentId;
    }

    /**
     * @return string $content
     */
    public function getCommentContent(): string
    {
        return $this->commentContent;
    }

    /**
     * @return \DateTime $publishDate
     */
    public function getPublishDate(): \DateTime
    {
        return $this->publishDate;
    }

    /**
     * @return bool $isValidated
     */
    public function getIsCommentValidated(): bool
    {
        return $this->isValidated;
    }

    /**
     * @return User $author
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @return Article $article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }
}
<?php

namespace App\Entity;

class Article
{
    private int $id;

    private string $content;

    private string $excerpt;

    private string $title;

    private string $slug;

    private \DateTime $publishDate;

    private \DateTime $updateDate;

    private string $thumbnailUrl;

    private Category $category;

    private User $author;

    private bool $isValidated;

    private bool $promote;

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

    public function setExcerpt(string $excerpt): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setPublishDate(\DateTime $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function setUpdateDate(\DateTime $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function setThumbnailUrl(string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function setIsValidated(bool $isValidated): self
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    public function setPromote(bool $promote): self
    {
        $this->promote = $promote;

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

    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPublishDate(): \DateTime
    {
        return $this->publishDate;
    }

    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getIsValidated(): bool
    {
        return $this->isValidated;
    }

    public function getPromote(): bool
    {
        return $this->promote;
    }
}

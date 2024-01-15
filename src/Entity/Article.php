<?php

namespace App\Entity;

use App\Validator\IsNotEmpty;

class Article
{
    private int $id;

    #[IsNotEmpty(message: 'Le contenue est obligatoire')]
    private string $content;

    #[IsNotEmpty(message: 'L\'éxtrait est obligatoire')]
    private string $excerpt;

    #[IsNotEmpty(message: 'Le titre est obligatoire')]
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

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param string $excerpt
     * @return self
     */
    public function setExcerpt(string $excerpt): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
     * @param \DateTime $updateDate
     * @return self
     */
    public function setUpdateDate(\DateTime $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * @param string $thumbnailUrl
     * @return self
     */
    public function setThumbnailUrl(string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * @param Category $category
     * @return self
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

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
     * @param bool $isValidated
     * @return self
     */
    public function setIsValidated(bool $isValidated): self
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    /**
     * @param bool $promote
     * @return self
     */
    public function setPromote(bool $promote): self
    {
        $this->promote = $promote;

        return $this;
    }

    // Getters

    /**
     * @return int $id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string $content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string $excerpt
     */
    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    /**
     * @return string $title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string $slug
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return \DateTime $publishDate
     */
    public function getPublishDate(): \DateTime
    {
        return $this->publishDate;
    }

    /**
     * @return \DateTime $updateDate
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    /**
     * @return string $thumbnailUrl
     */
    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @return Category $category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @return User $author
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @return bool $isValidated
     */
    public function getIsValidated(): bool
    {
        return $this->isValidated;
    }

    /**
     * @return bool $promote
     */
    public function getPromote(): bool
    {
        return $this->promote;
    }
}

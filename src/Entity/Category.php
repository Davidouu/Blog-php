<?php

namespace App\Entity;

use App\Validator\IsNotEmpty;

class category
{
    private int $categoryId;

    #[IsNotEmpty(message: 'Le contenue est obligatoire')]
    private string $name;

    private string $categorySlug;

    // Setters

    /**
     * @param int $id
     * @return self
     */
    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @param string $content
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $categorySlug
     * @return self
     */
    public function setCategorySlug(string $categorySlug): self
    {
        $this->categorySlug = $categorySlug;

        return $this;
    }

    // Getters

    /**
     * @return int $categoryId
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @return string $content
     */
    public function getName(): string
    {
        return ucfirst($this->name);
    }

    /**
     * @return string $categorySlug
     */
    public function getCategorySlug(): string
    {
        return $this->categorySlug;
    }
}

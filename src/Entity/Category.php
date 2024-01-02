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
    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setCategorySlug(string $categorySlug): self
    {
        $this->categorySlug = $categorySlug;

        return $this;
    }

    // Getters
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getName(): string
    {
        return ucfirst($this->name);
    }

    public function getCategorySlug(): string
    {
        return $this->categorySlug;
    }
}

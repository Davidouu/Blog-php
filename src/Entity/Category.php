<?php

namespace App\Entity;

class category
{
    private int $id;

    private string $name;

    private string $categorySlug;

    // Setters
    public function setId(int $id): self
    {
        $this->id = $id;

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
    public function getId(): ?int
    {
        return $this->id;
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

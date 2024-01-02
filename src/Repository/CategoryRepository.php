<?php

namespace App\Repository;

use App\DAL;
use App\Entity\Category;
use App\Hydrator;

class CategoryRepository
{
    private DAL $dal;

    private Hydrator $hydrator;

    public function __construct()
    {
        $this->dal = new DAL();
        $this->hydrator = new Hydrator();
    }

    /*
    * @return Category[]
    */
    public function getAllCategories()
    {
        $sql = 'SELECT * FROM category';

        $this->dal->execute($sql);
        $data = $this->dal->fetchData('all');

        foreach ($data as &$category) {
            $categoryObject = new Category();
            $this->hydrator->hydrate($categoryObject, $category);

            $categories[] = $categoryObject;
        }

        return $categories;
    }

    /*
    * @param int $id
    * @return Category|null
    */
    public function getCategoryById(int $id)
    {
        $sql = 'SELECT * FROM category WHERE categoryId = :id';

        $this->dal->execute($sql, ['id' => $id]);
        $data = $this->dal->fetchData('one');

        if ($data === false) {
            return null;
        }

        $category = new Category();
        $this->hydrator->hydrate($category, $data);

        return $category;
    }

    /*
    * @param Category $category
    * @return bool
    */
    public function newCategory(Category $category)
    {
        $sql = 'INSERT INTO category (name, categorySlug) VALUES (:name, :categorySlug)';

        $this->dal->execute($sql, ['name' => $category->getName(), 'categorySlug' => $category->getCategorySlug()]);

        return true;
    }

    /*
    * @param Category $category
    * @return bool
    */
    public function editCategory(Category $category)
    {
        $sql = 'UPDATE category SET name = :name, categorySlug = :categorySlug WHERE categoryId = :id';

        $this->dal->execute($sql, ['name' => $category->getName(), 'categorySlug' => $category->getCategorySlug(), 'id' => $category->getCategoryId()]);

        return true;
    }

    /*
    * @param int $id
    * @return bool
    */
    public function deleteCategory(int $id)
    {
        $sql = 'DELETE FROM category WHERE categoryId = :id';

        if (! $this->dal->execute($sql, ['id' => $id])) {
            return false;
        }

        return true;
    }
}

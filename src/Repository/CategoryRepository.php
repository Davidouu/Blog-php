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
}

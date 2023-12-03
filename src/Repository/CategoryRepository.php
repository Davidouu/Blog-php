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
}

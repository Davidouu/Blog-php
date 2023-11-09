<?php

namespace App\Repository;

use App\DAL;
use App\Hydrator;

class ArticlesRepository
{
    private DAL $dal;

    private Hydrator $hydrator;

    public function __construct()
    {
        $this->dal = new DAL();
        $this->hydrator = new Hydrator();
    }

    // Get all articles
    public function getAllArticles(?array $arrayOrder, ?int $articlesLimit): array
    {
        $sql = 'SELECT * FROM article
                INNER JOIN category ON article.categoryId = category.id 
                INNER JOIN user ON article.authorId = user.id';

        if (isset($arrayOrder)) {
            $sql .= ' ORDER BY '.$arrayOrder['column'].' '.$arrayOrder['order'];
        }

        if (isset($articlesLimit)) {
            $sql .= ' LIMIT '.$articlesLimit;
        }

        $this->dal->execute($sql);
        $data = $this->dal->fetchData('all');

        // foreach ($data as $key => $value) {
        // }

        return $data;
    }
}

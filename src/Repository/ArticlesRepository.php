<?php

namespace App\Repository;

use App\DAL;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
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

    /*
    * @param array|null $arrayOrder
    * @param int|null $articlesLimit
    * @return array
    */
    public function getAllArticles(?array $arrayOrder, ?int $articlesLimit): array
    {
        $sql = 'SELECT * FROM article
                INNER JOIN category ON article.categoryId = category.categoryId 
                INNER JOIN user ON article.authorId = user.userId';

        if (isset($arrayOrder)) {
            $sql .= ' ORDER BY '.$arrayOrder['column'].' '.$arrayOrder['order'];
        }

        if (isset($articlesLimit)) {
            $sql .= ' LIMIT '.$articlesLimit;
        }

        $this->dal->execute($sql);
        $data = $this->dal->fetchData('all');

        foreach ($data as &$article) {
            $categroy = new Category();
            $this->hydrator->hydrate($categroy, $article);

            $article['category'] = $categroy;

            $user = new User();
            $this->hydrator->hydrate($user, $article);

            $article['author'] = $user;

            $articleObject = new Article();
            $this->hydrator->hydrate($articleObject, $article);

            $articles[] = $articleObject;
        }

        return $articles;
    }

    /*
    * @param int $id
    * @return array|null
    */
    public function getArticleById(int $id): ?array
    {
        $sql = 'SELECT * FROM article
                INNER JOIN category ON article.categoryId = category.categoryId 
                INNER JOIN user ON article.authorId = user.userId
                WHERE article.id = :id';

        $this->dal->execute($sql, ['id' => $id]);
        $data = $this->dal->fetchData('one');

        if ($data === false) {
            return null;
        }

        $categroy = new Category();
        $this->hydrator->hydrate($categroy, $data);

        $data['category'] = $categroy;

        $user = new User();
        $this->hydrator->hydrate($user, $data);

        $data['author'] = $user;

        $articleObject = new Article();
        $this->hydrator->hydrate($articleObject, $data);

        return $data;

    }

    /*
    * @param Article $article
    * @return bool
    */
    public function createArticle(Article $article): bool
    {
        $sql = 'INSERT INTO article (content, excerpt, title, slug, thumbnailUrl, categoryId, authorId, isValidated, promote)
                VALUES (:content, :excerpt, :title, :slug, :thumbnailUrl, :categoryId, :authorId, :isValidated, :promote)';

        return $this->dal->execute($sql, [
            'content' => $article->getContent(),
            'excerpt' => $article->getExcerpt(),
            'title' => $article->getTitle(),
            'slug' => $article->getSlug(),
            'thumbnailUrl' => $article->getThumbnailUrl(),
            'categoryId' => $article->getCategory()->getCategoryId(),
            'authorId' => $article->getAuthor()->getUserId(),
            'isValidated' => $article->getIsValidated() ? 1 : 0,
            'promote' => $article->getPromote() ? 1 : 0,
        ]);
    }

    /*
    * @param Article $article
    * @return bool
    */
    public function updateArticle(Article $article): bool
    {
        $sql = 'UPDATE article SET content = :content, excerpt = :excerpt, title = :title, slug = :slug, thumbnailUrl = :thumbnailUrl, categoryId = :categoryId, authorId = :authorId, isValidated = :isValidated, promote = :promote
                WHERE id = :id';

        return $this->dal->execute($sql, [
            'content' => $article->getContent(),
            'excerpt' => $article->getExcerpt(),
            'title' => $article->getTitle(),
            'slug' => $article->getSlug(),
            'thumbnailUrl' => $article->getThumbnailUrl(),
            'categoryId' => $article->getCategory()->getCategoryId(),
            'authorId' => $article->getAuthor()->getUserId(),
            'isValidated' => $article->getIsValidated() ? 1 : 0,
            'promote' => $article->getPromote() ? 1 : 0,
            'id' => $article->getId(),
        ]);
    }

    /*
    * @param int $id
    * @return bool
    */
    public function deleteArticle(int $id): bool
    {
        $sql = 'DELETE FROM article WHERE id = :id';

        return $this->dal->execute($sql, ['id' => $id]);
    }
}

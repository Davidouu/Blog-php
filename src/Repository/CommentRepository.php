<?php

namespace App\Repository;

use App\DAL;
use App\Entity\Comment;
use App\Hydrator;

class CommentRepository
{
    private DAL $dal;

    private Hydrator $hydrator;

    public function __construct()
    {
        $this->dal = new DAL();
        $this->hydrator = new Hydrator();
    }

    /*
    * @param Comment $comment
    * @return bool
    */
    public function addComment(Comment $comment): bool
    {
        $sql = 'INSERT INTO comment (content, isValidated, authorId, articleId) VALUES (:content, :isValidated, :authorId, :articleId)';

        $this->dal->execute($sql, [
            'content' => $comment->getContent(),
            'isValidated' => $comment->getIsValidated() ? 1 : 0,
            'authorId' => $comment->getAuthor()->getUserId(),
            'articleId' => $comment->getArticle()->getId()
        ]);

        return $this->dal->getLastInsertId();
    }
}
<?php

namespace App\Repository;

use App\DAL;
use App\Entity\Comment;
use App\Entity\Article;
use App\Entity\User;
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
        $sql = 'INSERT INTO comment (commentContent, isCommentValidated, authorId, articleId) VALUES (:commentContent, :isCommentValidated, :authorId, :articleId)';

        $this->dal->execute($sql, [
            'commentContent' => $comment->getCommentContent(),
            'isCommentValidated' => $comment->getIsCommentValidated() ? 1 : 0,
            'authorId' => $comment->getAuthor()->getUserId(),
            'articleId' => $comment->getArticle()->getId()
        ]);

        return $this->dal->getLastInsertId();
    }

    /*
    * @return bool|array
    */
    public function getAllComments(?array $arrayOrder): bool|array
    {
        $sql = 'SELECT * FROM comment 
                INNER JOIN article ON comment.articleId = article.id 
                INNER JOIN user ON comment.authorId = user.userId';

        if (isset($arrayOrder)) {
            $sql .= ' ORDER BY '.$arrayOrder['column'].' '.$arrayOrder['order'];
        }

        $this->dal->execute($sql);
        $data = $this->dal->fetchData('all');

        // If no data
        if (empty($data)) {
            return $data;
        }

        foreach ($data as &$comment) {
            $article = new Article();
            $this->hydrator->hydrate($article, $comment);

            $comment['article'] = $article;

            $user = new User();
            $this->hydrator->hydrate($user, $comment);

            $comment['author'] = $user;

            $commentObject = new Comment();
            $this->hydrator->hydrate($commentObject, $comment);

            $comments[] = $commentObject;
        }

        return $comments;
    }

    /*
    * @param int $id
    * @return bool|array
    */
    public function getCommentsByArticleId(int $id): bool|array
    {
        $sql = 'SELECT * FROM comment 
                INNER JOIN article ON comment.articleId = article.id 
                INNER JOIN user ON comment.authorId = user.userId 
                WHERE article.id = :id 
                ORDER BY comment.publishedAt DESC';

        $this->dal->execute($sql, ['id' => $id]);
        $data = $this->dal->fetchData('all');

        // If no data
        if (empty($data)) {
            return $data;
        }

        foreach ($data as &$comment) {
            $article = new Article();
            $this->hydrator->hydrate($article, $comment);

            $comment['article'] = $article;

            $user = new User();
            $this->hydrator->hydrate($user, $comment);

            $comment['author'] = $user;

            $commentObject = new Comment();
            $this->hydrator->hydrate($commentObject, $comment);

            $comments[] = $commentObject;
        }

        return $comments;
    }

    /*
    * @param int $id
    * @return bool|Comment
    */
    public function getCommentById(int $id): bool|Comment
    {
        $sql = 'SELECT * FROM comment 
                INNER JOIN article ON comment.articleId = article.id 
                INNER JOIN user ON comment.authorId = user.userId 
                WHERE comment.commentId = :id';
        
        $this->dal->execute($sql, ['id' => $id]);
        $data = $this->dal->fetchData('one');

        if ($data === false) {
            return null;
        }

        $article = new Article();
        $this->hydrator->hydrate($article, $data);

        $data['article'] = $article;

        $user = new User();
        $this->hydrator->hydrate($user, $data);

        $data['author'] = $user;

        $comment = new Comment();
        $this->hydrator->hydrate($comment, $data);

        return $comment;
    }

    /*
    * @param Comment $comment
    * @return bool
    */
    public function updateComment(Comment $comment): bool
    {
        $sql = 'UPDATE comment SET commentContent = :commentContent, isCommentValidated = :isCommentValidated, authorId = :authorId, articleId = :articleId WHERE commentId = :commentId';

        return $this->dal->execute($sql, [
            'commentContent' => $comment->getCommentContent(),
            'isCommentValidated' => $comment->getIsCommentValidated() ? 1 : 0,
            'authorId' => $comment->getAuthor()->getUserId(),
            'articleId' => $comment->getArticle()->getId(),
            'commentId' => $comment->getCommentId()
        ]);
    }

    /*
    * @param Comment $comment
    * @return bool
    */
    public function deleteComment(Comment $comment): bool
    {
        $sql = 'DELETE FROM comment WHERE commentId = :commentId';

        return $this->dal->execute($sql, ['commentId' => $comment->getCommentId()]);
    }
}
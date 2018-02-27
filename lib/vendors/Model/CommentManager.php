<?php
namespace Model;

use EmmaM\Manager;
use Entity\Comment;

class CommentManager extends Manager
{
    public function getAllComments()
    {
        $requete = $this->getDb()->query('SELECT * FROM Comment ORDER BY online, commentDate DESC');
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        return $requete->fetchAll();
    }

    public function getCommentById($commentId)
    {
        $requete = $this->getDb()->prepare('SELECT * FROM Comment WHERE id = :id');
        $requete->bindValue(':id', $commentId, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        return $requete->fetch();
    }

    public function getPublishedCommentsByPostId($postId)
    {
        $requete = $this->getDb()->prepare('SELECT * FROM Comment WHERE postId = :postId AND online = TRUE');
        $requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        return $comments = $requete->fetchAll();
    }

    public function getNewComments()
    {
        $requete = $this->getDb()->query('SELECT COUNT(*) FROM Comment WHERE online = false');
        return $requete->fetchColumn();
    }

    public function countComments()
    {
        $requete = $this->getDb()->query('SELECT COUNT(*) FROM Comment');
        return $requete->fetchColumn();
    }

    public function addComment(Comment $comment)
    {
        $requete = $this->getDb()->prepare(
            'INSERT INTO Comment (author, commentContent, commentDate, postId) 
            VALUES (:author, :commentContent, :commentDate, :postId)'
        );

        $requete->bindValue(':author', $comment->getAuthor());
        $requete->bindValue(':commentContent', $comment->getCommentContent(), \PDO::PARAM_STR);
        $requete->bindValue(':commentDate', $comment->getCommentDate(), \PDO::PARAM_STR);
        $requete->bindValue(':postId', $comment->getPostId(), \PDO::PARAM_STR);

        $requete->execute();
    }

    public function validateComment(Comment $comment)
    {
        $requete = $this->getDb()->prepare('UPDATE Comment SET online = :online WHERE id = :id');
        $requete->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
        $requete->bindValue(':online', $comment->getOnline());
        $requete->execute();
    }

    public function deleteComment(Comment $comment)
    {
        $requete = $this->getDb()->prepare('DELETE FROM Comment WHERE id = :id');
        $requete->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
        $requete->execute();
    }
}
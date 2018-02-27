<?php
namespace Model;

use EmmaM\Manager;
use Entity\Post;

class PostManager extends Manager
{
    public function getAllPosts()
    {
        $requete = $this->getDb()->query('SELECT * FROM Post ORDER BY publishedAt DESC');
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
        return $requete->fetchAll();
    }

    public function getHomePosts()
    {
        $requete = $this->getDb()->query('SELECT * FROM Post ORDER BY publishedAt DESC LIMIT 6');
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
        return $posts = $requete->fetchAll();
        $requete->closeCursor();
    }

    public function getPostById($postId)
    {
        $requete = $this->getDb()->prepare('SELECT * FROM Post WHERE id = :id');
        $requete->bindValue(':id', $postId, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
        return $requete->fetch();
    }

    public function countPosts()
    {
        $requete = $this->getDb()->query('SELECT COUNT(*) FROM Post');
        return $requete->fetchColumn();
    }

    public function addPost(Post $post)
    {
        $requete = $this->getDb()->prepare(
            'INSERT INTO Post (author, title, link, preface, postContent, publishedAt) 
            VALUES (:author, :title, :link, :preface, :postContent, :publishedAt)'
        );

        $requete->bindValue(':author', $post->getAuthor());
        $requete->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $requete->bindValue(':link', $post->getLink(), \PDO::PARAM_STR);
        $requete->bindValue(':preface', $post->getPreface(), \PDO::PARAM_STR);
        $requete->bindValue(':postContent', $post->getPostContent(), \PDO::PARAM_STR);
        $requete->bindValue(':publishedAt', $post->getPublishedAt());

        $requete->execute();
    }

    public function updatePost(Post $post)
    {
        $requete = $this->getDb()->prepare(
            'UPDATE Post SET title = :title, link = :link, preface = :preface, postContent = :postContent, updatedAt = :updatedAt 
            WHERE id = :id'
        );

        $requete->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
        $requete->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $requete->bindValue(':link', $post->getLink(), \PDO::PARAM_STR);
        $requete->bindValue(':preface', $post->getPreface(), \PDO::PARAM_STR);
        $requete->bindValue(':postContent', $post->getPostContent(), \PDO::PARAM_STR);
        $requete->bindValue(':updatedAt', $post->getUpdatedAt());

        $requete->execute();
    }

    public function deletePost($postId)
    {
        $requete = $this->getDb()->prepare('DELETE FROM Post WHERE id = :id');
        $requete->bindValue(':id', $postId, \PDO::PARAM_INT);
        $requete->execute();
    }
}
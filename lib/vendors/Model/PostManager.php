<?php
namespace Model;

use EmmaM\Manager;
use Entity\Post;

class PostManager extends Manager
{
	public function getAllPosts()
	{
		$db = $this->getDbConnexion();

		$requete = $db->query('SELECT * FROM Post ORDER BY publishedAt DESC');
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
		$posts = $requete->fetchAll();

		return $posts;
	}

	public function getSixLastPosts()
	{
		$db = $this->getDbConnexion();

		$requete = $db->query('SELECT * FROM Post ORDER BY publishedAt DESC LIMIT 6');
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
		$posts = $requete->fetchAll();
		$requete->closeCursor();
		return $posts;
	}

	public function getPostById($postId)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('SELECT * FROM Post WHERE id = :id');
		$requete->bindValue(':id', $postId, \PDO::PARAM_INT);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
		$post = $requete->fetch();

		return $post;
	}

	public function addPost(Post $post)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('INSERT INTO Post (author, title, preface, postContent, publishedAt) 
			VALUES (:author, :title, :preface, :postContent, :publishedAt)');
		$requete->bindValue(':author', $post->getAuthor());
        $requete->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $requete->bindValue(':preface', $post->getPreface(), \PDO::PARAM_STR);
        $requete->bindValue(':postContent', $post->getPostContent(), \PDO::PARAM_STR);
        $requete->bindValue(':publishedAt', $post->getPublishedAt());

		$requete->execute();

		return $postId = $bdd->lastInsertId();
	}

	public function updatePost(Post $post)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('UPDATE Post SET title = :title, preface = :preface, postContent = :postContent,
			updatedAt = :updatedAt WHERE id = :id');
        $requete->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
		$requete->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $requete->bindValue(':preface', $post->getPreface(), \PDO::PARAM_STR);
        $requete->bindValue(':postContent', $post->getPostContent(), \PDO::PARAM_STR);
        $requete->bindValue(':updatedAt', $post->getUpdatedAt());

        $requete->execute();
	}

	public function deletePost(Post $post)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('DELETE FROM Post WHERE id = :id');
		$requete->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
		$requete->execute();
	}
}
<?php

require_once ('lib/Comment.php');

class CommentManager
{
	private function getDbConnexion()
	{
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=blogperso;charset=utf8', 'root', 'root');
			return $bdd;
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}	
	}

	public function getAllComments()
	{
		$bdd = $this->getDbConnexion();

		$requete = $bdd->query('SELECT * FROM Comment ORDER BY postId DESC, commentDate DESC');
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Comment');
		$comments = $requete->fetchAll();

		return $comments;
	}

	public function getPublishedCommentsByPostId($postId)
	{
		$bdd = $this->getDbConnexion();

		$requete = $bdd->prepare('SELECT * FROM Comment WHERE postId = :postId AND online = TRUE');
		$requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Comment');
		$comments = $requete->fetchAll();

        return $comments;
	}

	public function getCommentById($commentId)
	{
		$bdd = $this->getDbConnexion();

		$requete = $bdd->prepare('SELECT * FROM Comment WHERE id = :id');
		$requete->bindValue(':id', $commentId, \PDO::PARAM_INT);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Comment');
		$comment = $requete->fetch();

		return $comment;
	}

	public function addComment(Comment $comment)
	{
		$bdd = $this->getDbConnexion();

		$requete = $bdd->prepare('INSERT INTO Comment (author, commentContent, commentDate, postId) VALUES (:author, :commentContent, :commentDate, :postId)');

		$requete->bindValue(':author', $comment->getAuthor());
        $requete->bindValue(':commentContent', $comment->getCommentContent(), \PDO::PARAM_STR);
        $requete->bindValue(':commentDate', $comment->getCommentDate(), \PDO::PARAM_STR);
        $requete->bindValue(':postId', $comment->getPostId(), \PDO::PARAM_STR);

		$requete->execute();

		//PREVENIR D'UN NOUVEAU COMMENTAIRE A VALIDER
	}

	public function validateComment(Comment $comment)
	{
		$bdd = $this->getDbConnexion();

		$requete = $bdd->prepare('UPDATE Comment SET online = :online WHERE id = :id');

        $requete->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
		$requete->bindValue(':online', $comment->getOnline());

        $requete->execute();
	}

	public function deleteComment(Comment $comment)
	{
		$bdd = $this->getDbConnexion();

		$requete = $bdd->prepare('DELETE FROM Comment WHERE id = :id');
		$requete->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);

		$requete->execute();
	}
}
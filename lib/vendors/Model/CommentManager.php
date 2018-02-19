<?php
namespace Model;

use EmmaM\Manager;
use Entity\Comment;

class CommentManager extends Manager
{
	public function getAllComments()
	{
		$db = $this->getDbConnexion();

		$requete = $db->query('SELECT * FROM Comment ORDER BY commentDate DESC');
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
		$comments = $requete->fetchAll();

		return $comments;
	}

	public function getCommentById($commentId)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('SELECT * FROM Comment WHERE id = :id');
		$requete->bindValue(':id', $commentId, \PDO::PARAM_INT);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
		$comment = $requete->fetch();

		return $comment;
	}

	public function getPublishedCommentsByPostId($postId)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('SELECT * FROM Comment WHERE postId = :postId AND online = TRUE');
		$requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
		$comments = $requete->fetchAll();

		return $comments;
	}

	public function addComment(Comment $comment)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('INSERT INTO Comment (author, commentContent, commentDate, postId) VALUES (:author, :commentContent, :commentDate, :postId)');

		$requete->bindValue(':author', $comment->getAuthor());
		$requete->bindValue(':commentContent', $comment->getCommentContent(), \PDO::PARAM_STR);
		$requete->bindValue(':commentDate', $comment->getCommentDate(), \PDO::PARAM_STR);
		$requete->bindValue(':postId', $comment->getPostId(), \PDO::PARAM_STR);

		$requete->execute();

		//PREVENIR D'UN NOUVEAU COMMENTAIRE A VALIDER
	}

	public function validateComment(Comment $comment)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('UPDATE Comment SET online = :online WHERE id = :id');

		$requete->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
		$requete->bindValue(':online', $comment->getOnline());

		$requete->execute();
	}

	public function deleteComment(Comment $comment)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('DELETE FROM Comment WHERE id = :id');
		$requete->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);

		$requete->execute();
	}
}
<?php

require_once('Model/CommentManager.php');
require_once('Model/PostManager.php');

class CommentController
{
	public function listComments()
	{
    	$commentManager = new CommentManager();
		$comments = $commentManager->getAllComments();

		$postManager = new PostManager();

		require('View/Comment/listCommentsView.php');
	}

	public function insertComment()
	{
		$commentManager = new CommentManager();

		$comment = new Comment([
			'author'		=> $_POST['author'],
			'commentContent' => $_POST['commentContent'],
			'commentDate' 	=> (date_format(new \Datetime(), 'Y-m-d H:i:s')),
			'postId'		=> $_GET['id']
		]);

		$commentManager->addComment($comment);

		require('View/Comment/addCommentAction.php');
	}

	public function validateComment($commentId)
	{
		$commentManager = new CommentManager();
		$commentToValidate = $commentManager->getCommentById($_GET['id']);

		$commentToValidate->setOnline(TRUE);

		$commentManager->validateComment($commentToValidate);

		header('Location:  index.php?action=listComments');
	}

	public function deleteComment($commentId)
	{
		$commentManager = new CommentManager();
		$commentToDelete = $commentManager->getCommentById($_GET['id']);

		$commentManager->deleteComment($commentToDelete);

		header('Location:  index.php?action=listComments');
	}
}
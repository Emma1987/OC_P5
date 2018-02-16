<?php
ini_set('display_errors','on');
error_reporting(E_ALL);

require('Controller/PostController.php');
require('Controller/CommentController.php');

$postController = new PostController();
$commentController = new CommentController();

try {
	if (isset($_GET['action']))
	{
		// POSTS

		if ($_GET['action'] == 'listPosts')
		{
			$postController->listPosts();
		}
		elseif ($_GET['action'] == 'post')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$post = $postController->postWithComments($_GET['id']); //POURQUOI JE DOIS METTRE LE TOUT DANS UNE VARIABLE ?
			}
		}
		elseif ($_GET['action'] == 'addPost')
		{
			$postController->insertPostForm();
		}
		elseif ($_GET['action'] == 'addPostAction')
		{
			$postController->insertPost();
		}
		elseif ($_GET['action'] == 'updatePost')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$postController->updatePostForm($_GET['id']);
			}
		}
		elseif ($_GET['action'] == 'updatePostAction')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$post = $postController->updatePost($_GET['id']);
			}
		}
		elseif ($_GET['action'] == 'deletePost')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$post = $postController->deletePost($_GET['id']);
			}
		}

		//COMMENTS
		
		elseif ($_GET['action'] == 'listComments')
		{
			$commentController->listComments();
		}
		elseif ($_GET['action'] == 'addComment')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$comment = $commentController->insertComment();
			}
		}
		elseif ($_GET['action'] == 'validateComment')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$comment = $commentController->validateComment($_GET['id']);
			}
		}
		elseif ($_GET['action'] == 'deleteComment')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$comment = $commentController->deleteComment($_GET['id']);
			}
		}
	}
	else {
		$postController->indexView();
	}
}
catch (Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}
<?php
ini_set('display_errors','on');
error_reporting(E_ALL);

require('Controller/PostController.php');

$postController = new PostController();

try {
	if (isset($_GET['action']))
	{
		if ($_GET['action'] == 'listPosts')
		{
			$postController->listPosts();
		}
		elseif ($_GET['action'] == 'post')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$post = $postController->postById($_GET['id']); //POURQUOI JE DOIS METTRE LE TOUT DANS UNE VARIABLE ?
			}
			require('View/postView.php');
		}
		elseif ($_GET['action'] == 'addPost')
		{
			require('View/addPost.php');
			$postController->insertPost();
		}
		elseif ($_GET['action'] == 'getPostToUpdate')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$post = $postController->postById($_GET['id']);
				require('View/getPostToUpdate.php');
			}
		}
		elseif ($_GET['action'] == 'updatePost')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$post = $postController->updatePost($_GET['id']);
				require('View/updatePost.php');
			}
		}
		elseif ($_GET['action'] == 'deletePost')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$post = $postController->deletePost($_GET['id']);
				require('View/deletePost.php');
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

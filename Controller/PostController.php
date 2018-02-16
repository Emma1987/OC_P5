<?php

require_once('Model/PostManager.php');
require_once('Model/CommentManager.php');
require_once('lib/Post.php');

class PostController
{
	public function indexView()
	{
		$postManager = new PostManager();
		$posts = $postManager->getSixLastPosts();
		require ('View/indexView.php');
	}

	public function listPosts()
	{
		$postManager = new PostManager();
		$posts = $postManager->getAllPosts();
		require('View/Post/listPostsView.php');
	}

	public function postWithComments($postId)
	{
		$postManager = new PostManager();
		$post = $postManager->getPostById($_GET['id']);
		
		$commentManager = new CommentManager();
		$comments = $commentManager->getPublishedCommentsByPostId($_GET['id']);
		require('View/Post/postView.php');
	}

	public function insertPostForm()
	{
		require('View/Post/addPost.php');
	}

	public function insertPost()
	{
		$postManager = new PostManager();

		if (!empty($_POST)) {
			$post = new Post([
				'author'	=> $_POST['author'],
				'title'		=> $_POST['title'],
				'preface'	=> $_POST['preface'],
				'postContent' => $_POST['postContent'],
				'publishedAt' => (date_format(new \Datetime(), 'Y-m-d H:i:s'))
			]);
			$postManager->addPost($post);
			require('View/Post/addPostAction.php');
		}
	}

	public function updatePostForm($postId)
	{
		$postManager = new PostManager();
		$post = $postManager->getPostById($postId);
		require('View/Post/updatePost.php');
	}

	public function updatePost($postId)
	{
		$postManager = new PostManager();
		$postToUpdate = $postManager->getPostById($_GET['id']);

		$postToUpdate->setTitle($_POST['title']);
		$postToUpdate->setPreface($_POST['preface']);
		$postToUpdate->setPostContent($_POST['postContent']);
		$postToUpdate->setUpdatedAt(date_format(new \Datetime(), 'Y-m-d H:i:s'));

		$postManager->updatePost($postToUpdate);

		require('View/Post/updatePostAction.php');
	}

	public function deletePost($postId)
	{
		$postManager = new PostManager();
		$postToDelete = $postManager->getPostById($_GET['id']);

		$postManager->deletePost($postToDelete);

		require('View/Post/deletePost.php');
	}
}
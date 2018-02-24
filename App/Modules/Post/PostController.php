<?php
namespace App\Modules\Post;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\Post;
use Entity\Comment;
use Entity\Image;

class PostController extends Controller
{
	public function executeIndex(HTTPRequest $request)
	{
		$posts = $this->manager->getManagerOf('Post')->getSixLastPosts();
		$images = $this->manager->getManagerOf('Image')->getAllImages();

		$this->page->addVar('posts', $posts);
		$this->page->addVar('images', $images);
	}

	public function executeListPosts()
	{
		$listPosts = $this->manager->getManagerOf('Post')->getAllPosts();
		$images = $this->manager->getManagerOf('Image')->getAllImages();

		$this->page->addVar('listPosts', $listPosts);
		$this->page->addVar('images', $images);
	}

	public function executePost(HTTPRequest $request)
	{
		$post = $this->manager->getManagerOf('Post')->getPostById($request->getData('id'));
		$comments = $this->manager->getManagerOf('Comment')->getPublishedCommentsByPostId($request->getData('id'));
		$categories = $this->manager->getManagerOf('Category')->getCategoriesByPost($request->getData('id'));
		$image = $this->manager->getManagerOf('Image')->getImageByPost($request->getData('id'));	

		$this->page->addVar('post', $post);
		$this->page->addVar('comments', $comments);
		$this->page->addVar('categories', $categories);
		$this->page->addVar('image', $image);
	}

	public function executeInsertPost(HTTPRequest $request)
	{
		$categories = $this->manager->getManagerOf('Category')->getAllCategories();
		$this->page->addVar('categories', $categories);

		$user = $this->manager->getManagerOf('User')->getUserById($_SESSION['auth']->getId());
		$this->page->addVar('user', $user);

		if ($request->postExists('authorValue'))
		{
			$post = new Post([
			 	'author'	=> $request->postData('authorValue'),
			 	'title'		=> $request->postData('title'),
			 	'preface'	=> $request->postData('preface'),
			 	'postContent' => $request->postData('postContent'),
			 	'publishedAt' => (date_format(new \Datetime(), 'Y-m-d H:i:s'))
			]);
			$postId = $this->manager->getManagerOf('Post')->addPost($post);

			foreach ($categories = $request->postData('categoryName') as $category)
			{
				$this->manager->getManagerOf('Category')->addCategoriesToPost($postId, $category);
			}

			$image = new Image([
				'tmpName'	=> $_FILES['image']['tmp_name'],
				'title'		=> $request->postData('imageTitle'),
				'extension'	=> $_FILES['image']['type'],
				'size'		=> $_FILES['image']['size'],
				'postId'	=> $postId,
				'url'		=> '/../../Web/uploads/img/' . $request->postData('imageTitle')
			]);

			$this->manager->getManagerOf('Image')->addImage($image);
			$image->save();

			$this->app->getHttpResponse()->redirect('/listPosts');
		}

	}

	public function executeUpdatePost(HTTPRequest $request)
	{
		$post = $this->manager->getManagerOf('Post')->getPostById($request->getData('id'));
		$selectedCategories = $this->manager->getManagerOf('Category')->getCategoriesByPost($request->getData('id'));
		$categories = $this->manager->getManagerOf('Category')->getAllCategories();
		$image = $this->manager->getManagerOf('Image')->getImageByPost($request->getData('id'));

		$this->page->addVar('post', $post);
		$this->page->addVar('categories', $categories);
		$this->page->addVar('selectedCategories', $selectedCategories);
		$this->page->addVar('image', $image);

		if ($request->postExists('preface'))
		{
			$post->setTitle($request->postData('title'));
			$post->setPreface($request->postData('preface'));
			$post->setPostContent($request->postData('postContent'));
			$post->setUpdatedAt(date_format(new \Datetime(), 'Y-m-d H:i:s'));

			$this->manager->getManagerOf('Post')->updatePost($post);

			if (!empty($request->postData('categoryName')))
			{
				foreach (($request->postData('categoryName')) as $category)
				{
					$this->manager->getManagerOf('Category')->addCategoriesToPost($request->getData('id'), $category);
				}
			}

			if (!empty($_FILES['image']))
			{
				$image = new Image([
					'tmpName'	=> $_FILES['image']['tmp_name'],
					'title'		=> $request->postData('imageTitle'),
					'extension'	=> $_FILES['image']['type'],
					'size'		=> $_FILES['image']['size'],
					'postId'	=> $post->getId(),
					'url'		=> '/../../Web/uploads/img/' . $request->postData('imageTitle')
				]);

				$this->manager->getManagerOf('Image')->addImage($image);
				$image->save();
			}

			$this->app->getHttpResponse()->redirect('/post-' . $request->getData('id'));
		}
	}

	public function executeDeletePost(HTTPRequest $request)
	{
		$this->manager->getManagerOf('Post')->deletePost($request->getData('id'));
		$this->app->getHttpResponse()->redirect('/listPosts');
	}
}
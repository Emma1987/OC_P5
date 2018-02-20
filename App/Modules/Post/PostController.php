<?php
namespace App\Modules\Post;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\Post;
use Entity\Comment;

class PostController extends Controller
{
	public function executeIndex(HTTPRequest $request)
	{
		$posts = $this->manager->getManagerOf('Post')->getSixLastPosts();

		$this->page->addVar('posts', $posts);
	}

	public function executeListPosts()
	{
		$listPosts = $this->manager->getManagerOf('Post')->getAllPosts();

		$this->page->addVar('listPosts', $listPosts);
	}

	public function executePost(HTTPRequest $request)
	{
		$post = $this->manager->getManagerOf('Post')->getPostById($request->getData('id'));
		$comments = $this->manager->getManagerOf('Comment')->getPublishedCommentsByPostId($request->getData('id'));
		$categories = $this->manager->getManagerOf('Category')->getCategoriesByPost($request->getData('id'));

		$this->page->addVar('post', $post);
		$this->page->addVar('comments', $comments);
		$this->page->addVar('categories', $categories);
	}

	public function executeInsertPost(HTTPRequest $request)
	{
		$categories = $this->manager->getManagerOf('Category')->getAllCategories();
		$this->page->addVar('categories', $categories);

		if ($request->postExists('author'))
		{
			$post = new Post([
			 	'author'	=> $request->postData('author'),
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

			$this->app->getHttpResponse()->redirect('/listPosts');
		}

	}

	public function executeUpdatePost(HTTPRequest $request)
	{
		$post = $this->manager->getManagerOf('Post')->getPostById($request->getData('id'));
		$selectedCategories = $this->manager->getManagerOf('Category')->getCategoriesByPost($request->getData('id'));
		$categories = $this->manager->getManagerOf('Category')->getAllCategories();

		$this->page->addVar('post', $post);
		$this->page->addVar('categories', $categories);
		$this->page->addVar('selectedCategories', $selectedCategories);

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

			$this->app->getHttpResponse()->redirect('/post-' . $request->getData('id'));
		}
	}

	public function executeDeletePost(HTTPRequest $request)
	{
		$this->manager->getManagerOf('Post')->deletePost($request->getData('id'));
		$this->app->getHttpResponse()->redirect('/listPosts');
	}
}
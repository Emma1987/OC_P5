<?php
namespace App\Modules\Comment;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\Comment;

class CommentController extends Controller
{
	public function executeListComments()
	{
		$comments = $this->manager->getManagerOf('Comment')->getAllComments();
		$posts = $this->manager->getManagerOf('Post')->getAllPosts();

		$this->page->addVar('comments', $comments);
		$this->page->addVar('posts', $posts);
	}

	public function executeInsertComment(HTTPRequest $request)
	{
		$comment = new Comment([
			'author'		=> $request->postData('author'),
			'commentContent' => $request->postData('commentContent'),
			'commentDate' 	=> (date_format(new \Datetime(), 'Y-m-d H:i:s')),
			'postId'		=> $request->getData('id')
		]);
		$this->manager->getManagerOf('Comment')->addComment($comment);
		$this->app->getHttpResponse()->redirect('post-' . $request->getData('id'));
	}

	public function executeValidateComment(HTTPRequest $request)
	{
		$comment = $this->manager->getManagerOf('Comment')->getCommentById($request->getData('id'));

		$comment->setOnline(TRUE);
		$this->manager->getManagerOf('Comment')->validateComment($comment);

		$this->app->getHttpResponse()->redirect('listComments');
	}

	public function executeDeleteComment(HTTPRequest $request)
	{
		$comment = $this->manager->getManagerOf('Comment')->getCommentById($request->getData('id'));
		$this->manager->getManagerOf('Comment')->deleteComment($comment);

		$this->app->getHttpResponse()->redirect('listComments');
	}
}
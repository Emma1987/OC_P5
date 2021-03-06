<?php

namespace Controller;

use App\Controller;
use App\HTTPRequest;
use Entity\Comment;
use App\Session;

class CommentController extends Controller
{
    /**
     * Return all the comments
     */
    public function executeListComments()
    {
        $this->adminLayout();
        $this->page->addVar('title', 'Liste des commentaires');

        $comments = $this->manager->getManagerOf('Comment')->getAllComments();
        $posts = $this->manager->getManagerOf('Post')->getAllPosts();

        foreach ($posts as $post) {
            $postArray[$post->getId()] = $post->getTitle();
        }

        $this->page->addVar('comments', $comments);
        $this->page->addVar('postArray', $postArray);
    }

    /**
     * Add a new comment and send a mail to the administrator
     * @param  HTTPRequest $request
     */
    public function executeInsertComment(HTTPRequest $request)
    {
        if ($request->postExists('authorValue')) {
            $comment = new Comment([
                'author'        => $request->postData('authorValue'),
                'commentContent' => $request->postData('commentContent'),
                'commentDate'   => (date_format(new \Datetime(), 'Y-m-d H:i:s')),
                'postId'        => $request->getData('id'),
                'userId'        => Session::getInstance()->getAttribute('auth')->getId()
            ]);

            if ($comment->getErrors() != null) {
                $comment->getErrorMessage();
            } else {
                $this->manager->getManagerOf('Comment')->addComment($comment);
                Session::getInstance()->setFlash(
                    'success', 
                    'Votre commentaire a bien été ajouté. Il sera visible dès qu\'un administrateur l\'aura validé.'
                );
                $comment->mailNewComment($this->app->getConfig()->getVarValue('mailAdmin'));
            }
        }
        $this->app->getHttpResponse()->redirect('post-' . $request->getData('id'));
    }

    /**
     * Validate a comment by changing the online status
     * @param  HTTPRequest $request
     */
    public function executeValidateComment(HTTPRequest $request)
    {
        $comment = $this->manager->getManagerOf('Comment')->getCommentById($request->getData('id'));

        $comment->setOnline(true);
        $this->manager->getManagerOf('Comment')->validateComment($comment);

        Session::getInstance()->setFlash('success', 'Le commentaire a bien été validé, et est désormais visible sur le site.');
        $this->app->getHttpResponse()->redirect('listComments');
    }

    /**
     * Delete a comment
     * @param  HTTPRequest $request
     */
    public function executeDeleteComment(HTTPRequest $request)
    {
        $comment = $this->manager->getManagerOf('Comment')->getCommentById($request->getData('id'));
        $this->manager->getManagerOf('Comment')->deleteComment($comment);

        Session::getInstance()->setFlash('success', 'Le commentaire a bien été supprimé.');
        $this->app->getHttpResponse()->redirect('listComments');
    }
}
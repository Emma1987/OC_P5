<?php

namespace Controller;

use App\Controller;
use App\HTTPRequest;
use Entity\Post;
use Entity\Image;
use App\Session;

class AdminController extends Controller
{
    /**
     * Render the homepage view
     */
    public function executeIndexAdmin()
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Accueil administration');

        $posts = $this->manager->getManagerOf('Post')->getAllPosts();
        $comments = $this->manager->getManagerOf('Comment')->getAllComments();
        $newComments = $this->manager->getManagerOf('Comment')->getNewComments();
        $categories = $this->manager->getManagerOf('Category')->getAllCategories();

        $this->page->addVar('posts', $posts);
        $this->page->addVar('comments', $comments);
        $this->page->addVar('newComments', $newComments);
        $this->page->addVar('categories', $categories);
    }

    /**
     * Return all the posts
     */
    public function executeListPostsAdmin()
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Liste des articles');

        $this->listPosts();
    }

    /**
     * Return one post
     */
    public function executePostAdmin()
    {
        $this->adminLayout();

        $this->post();
    }
}
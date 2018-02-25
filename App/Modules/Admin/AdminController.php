<?php
namespace App\Modules\Admin;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\Post;
use Entity\Image;
use EmmaM\Session;

class AdminController extends Controller
{
    public function executeIndexAdmin(HTTPRequest $request)
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

    public function executeListPostsAdmin()
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Liste des articles');

        $this->listPosts();
    }

    public function executePostAdmin(HTTPRequest $request)
    {
        $this->adminLayout();

        $this->post();
    }
}
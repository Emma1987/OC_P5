<?php

namespace Controller;

use App\Controller;
use App\HTTPRequest;
use Entity\Post;
use Entity\Image;
use App\Session;

class PostController extends Controller
{
    /**
     * Render the homepage view
     */
    public function executeIndex()
    {
        $this->page->addVar('title', 'Emmanuelle Mercadal');
        $this->page->addVar('contentClass', 'homeContent');

        $posts = $this->manager->getManagerOf('Post')->getHomePosts();
        $images = $this->manager->getManagerOf('Image')->getAllImages();

        foreach ($images as $image) {
            $postImage[$image->getPostId()] = $image->getTitle() . $image->getPostId() . '.' . $image->getExtension();
        }

        $this->page->addVar('posts', $posts);
        $this->page->addVar('postImage', $postImage);
    }

    /**
     * Return all the posts
     */
    public function executeListPostsFront()
    {
        $this->page->addVar('title', 'Tous les articles');
        $this->page->addVar('contentClass', 'content');

        $this->listPosts();
    }

    /**
     * Return one post
     */
    public function executePost()
    {
        $this->page->addVar('contentClass', 'content');

        $this->post();

        if (Session::getInstance()->isActive()) {
            $user = $this->manager->getManagerOf('User')->getUserById(Session::getInstance()->getAttribute('auth')->getId());
            $this->page->addVar('user', $user);
        }
    }

    /**
     * Add a new post with associated image and categories
     * @param  HTTPRequest $request
     */
    public function executeInsertPost(HTTPRequest $request)
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Ajouter un article');

        $categories = $this->manager->getManagerOf('Category')->getAllCategories();
        $this->page->addVar('categories', $categories);

        $user = $this->manager->getManagerOf('User')->getUserById(Session::getInstance()->getAttribute('auth')->getId());
        $this->page->addVar('user', $user);

        if ($request->postExists('author')) {
            // POST
            $post = new Post([
                'author'    => $request->postData('author'),
                'title'     => $request->postData('title'),
                'link'      => $request->postData('link'),
                'preface'   => $request->postData('preface'),
                'postContent' => $request->postData('postContent'),
                'publishedAt' => (date_format(new \Datetime(), 'Y-m-d H:i:s')),
                'userId'    => $user->getId()
            ]);

            if (($errors = $post->getErrors()) != null) {
                $post->getErrorMessage();
                return;
            } else {
                $this->manager->getManagerOf('Post')->addPost($post);
            }

            // CATEGORIES
            $this->addCategories($request->postData('categoryName'), $this->manager->getManagerOf('Post')->lastInsertId());

            // IMAGE
            if (!empty($_FILES['image']) && !empty($request->postData('imageTitle'))) {
                $image = new Image([
                    'tmpName'   => $_FILES['image']['tmp_name'],
                    'title'     => preg_replace('#\s#', "", $request->postData('imageTitle')),
                    'extension' => substr(strrchr($_FILES['image']['type'], "/"), 1),
                    'size'      => $_FILES['image']['size'],
                    'postId'    => $this->manager->getManagerOf('Post')->lastInsertId()
                ]);

                if (($errors = $image->getErrors()) != null) {
                    $image->getErrorMessage();
                    return;
                } else {
                    $image->saveAndResize();
                    $this->manager->getManagerOf('Image')->addImage($image);
                }
            }
            Session::getInstance()->setFlash('success', 'Votre article a bien été ajouté !');
            $this->app->getHttpResponse()->redirect('/admin/post-' . $this->manager->getManagerOf('Post')->lastInsertId());
        }
    }

    /**
     * Update a post and its associated image and categories
     * @param  HTTPRequest $request
     */
    public function executeUpdatePost(HTTPRequest $request)
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Modification d\'un article');

        $post = $this->manager->getManagerOf('Post')->getPostById($request->getData('id'));
        $image = $this->manager->getManagerOf('Image')->getImageByPost($request->getData('id'));
        $selectedCategories = $this->manager->getManagerOf('Category')->getCategoriesByPost($request->getData('id'));
        $categories = $this->manager->getManagerOf('Category')->getAllCategories();

        $this->page->addVar('post', $post);
        $this->page->addVar('image', $image);
        $this->page->addVar('categories', $categories);

        if (!empty($selectedCategories)) {
            foreach ($selectedCategories as $selectedCategory) {
                $postCategories[$selectedCategory->getId()] = $selectedCategory->getName();
            }
            $this->page->addVar('postCategories', $postCategories);
        }

        if ($request->postExists('preface')) {
            // POST
            $post->setTitle($request->postData('title'));
            $post->setLink($request->postData('link'));
            $post->setPreface($request->postData('preface'));
            $post->setPostContent($request->postData('postContent'));
            $post->setUpdatedAt(date_format(new \Datetime(), 'Y-m-d H:i:s'));

            if (($errors = $post->getErrors()) != null) {
                $post->getErrorMessage();
                return;
            } else {
                $this->manager->getManagerOf('Post')->updatePost($post);
            }

            // CATEGORIES
            $this->addCategories($request->postData('categoryName'), $request->getData('id'));

            // IMAGE
            if (!empty($_FILES['image']) && !empty($request->postData('imageTitle'))) {
                $image = new Image([
                    'tmpName'   => $_FILES['image']['tmp_name'],
                    'title'     => preg_replace('#\s#', "", $request->postData('imageTitle')),
                    'extension' => substr(strrchr($_FILES['image']['type'], "/"), 1),
                    'size'      => $_FILES['image']['size'],
                    'postId'    => $post->getId(),
                ]);

                if (($errors = $image->getErrors()) != null) {
                    $image->getErrorMessage();
                    return;
                } else {
                    $image->saveAndResize();
                    $this->manager->getManagerOf('Image')->addImage($image);
                }
            }
            Session::getInstance()->setFlash('success', 'Votre article a bien été modifié !');
            $this->app->getHttpResponse()->redirect('/admin/post-' . $request->getData('id'));
        }
    }

    /**
     * Delete a post
     * @param  HTTPRequest $request
     */
    public function executeDeletePost(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Post')->deletePost($request->getData('id'));
        Session::getInstance()->setFlash('success', 'L\'article a bien été supprimé.');
        $this->app->getHttpResponse()->redirect('/admin/listPosts');
    }

    /**
     * Add categories on insert and update post methods
     * @param string $categoryName
     * @param int $postId
     */
    private function addCategories($categoryName, $postId)
    {
        if (!empty($categoryName)) {
            foreach ($categoryName as $category) {
                $this->manager->getManagerOf('Category')->addCategoriesToPost($postId, $category);
            }
        }
    }
}
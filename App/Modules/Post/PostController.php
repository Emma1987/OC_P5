<?php
namespace App\Modules\Post;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\Post;
use Entity\Image;
use EmmaM\Session;

class PostController extends Controller
{
    public function executeIndex(HTTPRequest $request)
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

    public function executeListPostsFront()
    {
        $this->page->addVar('title', 'Tous les articles');
        $this->page->addVar('contentClass', 'content');

        $this->listPosts();
    }

    public function executePost(HTTPRequest $request)
    {
        $this->page->addVar('contentClass', 'content');

        $this->post();

        if (Session::getInstance()->isActive()) {
            $user = $this->manager->getManagerOf('User')->getUserById($_SESSION['auth']->getId());
            $this->page->addVar('user', $user);
        }
    }

    public function executeInsertPost(HTTPRequest $request)
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Ajouter un article');

        $categories = $this->manager->getManagerOf('Category')->getAllCategories();
        $this->page->addVar('categories', $categories);

        $user = $this->manager->getManagerOf('User')->getUserById($_SESSION['auth']->getId());
        $this->page->addVar('user', $user);

        if ($request->postExists('author')) {
            // POST
            $post = new Post([
                'author'    => $request->postData('author'),
                'title'     => $request->postData('title'),
                'link'      => $request->postData('link'),
                'preface'   => $request->postData('preface'),
                'postContent' => $request->postData('postContent'),
                'publishedAt' => (date_format(new \Datetime(), 'Y-m-d H:i:s'))
            ]);
            
            if (($errors = $post->getErrors()) != null) {
                $post->getErrorMessage();
                return;
            } else {
                $this->manager->getManagerOf('Post')->addPost($post);
            }

            // CATEGORIES
            if (!empty($request->postData('categoryName'))) {
                foreach ($categories = $request->postData('categoryName') as $category) {
                    $this->manager->getManagerOf('Category')->addCategoriesToPost($this->manager->getManagerOf('Post')->lastInsertId(), $category);
                }
            }

            // IMAGE
            if (!empty($_FILES['image'])) {
                $image = new Image([
                    'tmpName'   => $_FILES['image']['tmp_name'],
                    'title'     => preg_replace('#\s#', "", $request->postData('imageTitle')),
                    'extension' => substr(strrchr($_FILES['image']['type'], "/"), 1),
                    'size'      => $_FILES['image']['size'],
                    'postId'    => $this->manager->getManagerOf('Post')->lastInsertId(),
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
            $this->app->getHttpResponse()->redirect('/admin/listPosts');
        }
    }

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
            if (!empty($request->postData('categoryName'))) {
                foreach (($request->postData('categoryName')) as $category) {
                    $this->manager->getManagerOf('Category')->addCategoriesToPost($request->getData('id'), $category);
                }
            }

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
            $this->app->getHttpResponse()->redirect('/post-' . $request->getData('id'));
        }
    }

    public function executeDeletePost(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Post')->deletePost($request->getData('id'));
        Session::getInstance()->setFlash('success', 'L\'article a bien été supprimé.');
        $this->app->getHttpResponse()->redirect('/admin/listPosts');
    }
}
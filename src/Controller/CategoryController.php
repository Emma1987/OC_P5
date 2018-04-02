<?php

namespace Controller;

use App\Controller;
use App\HTTPRequest;
use Entity\Category;
use App\Session;

class CategoryController extends Controller
{
    /**
     * Return all the categories
     */
    public function executeListCategories()
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Liste des catégories');

        $listCategories = $this->manager->getManagerOf('Category')->getAllCategories();

        $this->page->addVar('categories', $listCategories);
    }

    /**
     * Add a new category from list categories view
     * @param  HTTPRequest $request
     */
    public function executeAddCategory(HTTPRequest $request)
    {
        $this->addCategory($request);
        $this->app->getHttpResponse()->redirect('/admin/listCategories');
    }

    /**
     * Add a new category from add post view
     * @param  HTTPRequest $request
     */
    public function executeAddCategoryNewPost(HTTPRequest $request)
    {
        $this->addCategory($request);
        $this->app->getHttpResponse()->redirect('/admin/addPost');
    }

    /**
     * Add a new category from update post view
     * @param  HTTPRequest $request
     */
    public function executeAddCategoryUpdate(HTTPRequest $request)
    {
        $this->addCategory($request);
        $this->app->getHttpResponse()->redirect('/admin/updatePost-' . $request->postData('postId'));

    }

    /**
     * Remove a category from add post view
     * @param  HTTPRequest $request
     */
    public function executeRemoveCategoryNewPost(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Category')->removeCategory($request->getData('id'));
        Session::getInstance()->setFlash('success', 'La catégorie a bien été supprimée.');
        $this->app->getHttpResponse()->redirect('/admin/addPost');
    }

    /**
     * Remove a category from list categories view
     * @param  HTTPRequest $request
     */
    public function executeRemoveCategory(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Category')->removeCategory($request->getData('id'));
        Session::getInstance()->setFlash('success', 'La catégorie a bien été supprimée.');
        $this->app->getHttpResponse()->redirect('/admin/listCategories');
    }

    /**
     * Remove a category associated to the post
     * @param  HTTPRequest $request
     */
    public function executeRemovePostCategory(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Category')->removePostCategory($request->getData('postId'), $request->getData('categoryId'));
        Session::getInstance()->setFlash('success', 'La catégorie a bien été supprimée de cet article.');
        $this->app->getHttpResponse()->redirect('/admin/updatePost-' . $request->getData('postId'));
    }

    /**
     * Add a new category
     * @param HTTPRequest $request
     */
    private function addCategory(HTTPRequest $request)
    {
        if ($this->manager->getManagerOf('Category')->getCategoryByName($request->postData('newCategory')) != null) {
            Session::getInstance()->setFlash('danger', 'Cette catégorie existe déjà.');
        } else {
            if ($request->postExists('newCategory') && ($this->manager->getManagerOf('Category')->getCategoryByName($request->postData('newCategory')) == false)) {
                $category = new Category(
                    ['name'  => $request->postData('newCategory')]
                );

                if ($category->getErrors() != null) {
                    $category->getErrorMessage();
                } else {
                    $this->manager->getManagerOf('Category')->addNewCategory($category);
                    Session::getInstance()->setFlash('success', 'Une nouvelle catégorie a été ajoutée.');
                }
            }
        }
    }
}
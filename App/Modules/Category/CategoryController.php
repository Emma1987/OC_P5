<?php
namespace App\Modules\Category;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\Category;
use EmmaM\Session;

class CategoryController extends Controller
{
    public function executeListCategories()
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Liste des catégories');

        $listCategories = $this->manager->getManagerOf('Category')->getAllCategories();

        $this->page->addVar('categories', $listCategories);
    }

    public function executeAddCategory(HTTPRequest $request)
    {
        $this->addCategory($request);
        $this->app->getHttpResponse()->redirect('/admin/listCategories');
    }

    public function executeAddCategoryNewPost(HTTPRequest $request)
    {
        $this->addCategory($request);
        $this->app->getHttpResponse()->redirect('/admin/addPost');
    }

    public function executeAddCategoryUpdate(HTTPRequest $request)
    {
        $this->addCategory($request);
        $this->app->getHttpResponse()->redirect('/admin/updatePost-' . $request->postData('postId'));

    }

    public function executeRemoveCategoryNewPost(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Category')->removeCategory($request->getData('id'));
        Session::getInstance()->setFlash('success', 'La catégorie a bien été supprimée.');
        $this->app->getHttpResponse()->redirect('/admin/addPost');
    }

    public function executeRemoveCategory(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Category')->removeCategory($request->getData('id'));
        Session::getInstance()->setFlash('success', 'La catégorie a bien été supprimée.');
        $this->app->getHttpResponse()->redirect('/admin/listCategories');
    }

    public function executeRemovePostCategory(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Category')->removePostCategory($request->getData('postId'), $request->getData('categoryId'));
        Session::getInstance()->setFlash('success', 'La catégorie a bien été supprimée de cet article.');
        $this->app->getHttpResponse()->redirect('/admin/updatePost-' . $request->getData('postId'));
    }

    private function addCategory(HTTPRequest $request)
    {
        if ($this->manager->getManagerOf('Category')->getCategoryByName($request->postData('newCategory')) != null) {
            Session::getInstance()->setFlash('danger', 'Cette catégorie existe déjà.');
        } else {
            if ($request->postExists('newCategory') && ($this->manager->getManagerOf('Category')->getCategoryByName($request->postData('newCategory')) == false)) {
                $category = new Category(
                    ['name'  => $request->postData('newCategory')]
                );

                if (($category->getErrors()) != null) {
                    $category->getErrorMessage();
                } else {
                    $this->manager->getManagerOf('Category')->addNewCategory($category);
                    Session::getInstance()->setFlash('success', 'Une nouvelle catégorie a été ajoutée.');
                }
            }
        }
    }
}
<?php
namespace App\Modules\Category;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\Category;

class CategoryController extends Controller
{
	public function executeListCategories()
	{
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
		$this->app->getHttpResponse()->redirect('/addPost');
	}

	public function executeAddCategoryUpdate(HTTPRequest $request)
	{
		$this->addCategory($request);
		$this->app->getHttpResponse()->redirect('/updatePost-' . $request->postData('postId'));

	}

	public function executeRemoveCategory(HTTPRequest $request)
	{
		$this->manager->getManagerOf('Category')->removeCategory($request->getData('id'));
		$this->app->getHttpResponse()->redirect('listCategories');
	}

	public function executeRemovePostCategory(HTTPRequest $request)
	{
		$this->manager->getManagerOf('Category')->removePostCategory($request->getData('postId'), $request->getData('categoryId'));
		$this->app->getHttpResponse()->redirect('/updatePost-' . $request->getData('postId'));
	}

	private function addCategory(HTTPRequest $request)
	{
		if ($request->postExists('newCategory'))
		{
			$category = new Category([
				'name'	=> $request->postData('newCategory')
			]);

			$this->manager->getManagerOf('Category')->addNewCategory($category);
		}
	}
}
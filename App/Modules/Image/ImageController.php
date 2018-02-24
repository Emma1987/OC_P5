<?php
namespace App\Modules\Image;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use EmmaM\Session;

class ImageController extends Controller
{
	public function executeDeleteImage(HTTPRequest $request)
	{
		$this->manager->getManagerOf('Image')->deleteImage($request->getData('id'));
		Session::getInstance()->setFlash('success', 'Cette image a bien été supprimée.');
		$this->app->getHttpResponse()->redirect('/updatePost-' . $request->getData('postId'));
	}
}
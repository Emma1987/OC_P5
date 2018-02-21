<?php
namespace App\Modules\Image;

use EmmaM\Controller;
use EmmaM\HTTPRequest;

class ImageController extends Controller
{
	public function executeDeleteImage(HTTPRequest $request)
	{
		$this->manager->getManagerOf('Image')->deleteImage($request->getData('id'));
		$this->app->getHttpResponse()->redirect('/updatePost-' . $request->getData('postId'));
	}
}
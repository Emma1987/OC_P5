<?php

namespace Controller;

use App\Controller;
use App\HTTPRequest;
use App\Session;

class ImageController extends Controller
{
    public function executeDeleteImage(HTTPRequest $request)
    {
        $this->manager->getManagerOf('Image')->deleteImage($request->getData('id'));
        Session::getInstance()->setFlash('success', 'Cette image a bien été supprimée.');
        $this->app->getHttpResponse()->redirect('/admin/updatePost-' . $request->getData('postId'));
    }
}
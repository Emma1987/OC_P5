<?php
namespace App\Modules\Contact;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\ContactForm;
use EmmaM\Session;

class ContactController extends Controller
{
    public function executeContactMessage(HTTPRequest $request)
    {
        if (!empty($request->postData('firstname'))) {
            $message = new ContactForm(
                ['firstname' => $request->postData('firstname'),
                'lastname'  => $request->postData('lastname'),
                'email'     => $request->postData('email'),
                'message'   => $request->postData('message')]
            );

            if (($errors = $message->getErrors()) != null) {
                $message->getErrorMessage();
            } else {
                $message->sendContactMessage($this->app->getConfig()->getVarValue('mailAdmin'));
                Session::getInstance()->setFlash(
                    'success', 
                    'Merci pour votre message ! Vous recevrez une réponse prochainement !'
                );
            }
            $this->app->getHttpResponse()->redirect('/');
        } else {
            Session::getInstance()->setFlash(
                'danger', 
                'Une erreur s\'est produite lors de l\'envoi de votre message, merci de réessayer.'
            );
            $this->app->getHttpResponse()->redirect('/');
        }
    }
}
<?php

namespace Controller;

use App\Controller;
use App\HTTPRequest;
use Entity\ContactForm;
use App\Session;

class ContactController extends Controller
{
    /**
     * Render the contact page view
     */
    public function executeContactPage()
    {
        $this->page->addVar('contentClass', 'contactContent');
        $this->page->addVar('title', 'Contact');
    }

    /**
     * Send a message from contact form on homepage
     * @param  HTTPRequest $request
     */
    public function executeContactMessage(HTTPRequest $request)
    {
        if (!empty($request->postData('firstname'))) {
            $message = new ContactForm(
                ['firstname' => $request->postData('firstname'),
                'lastname'  => $request->postData('lastname'),
                'email'     => $request->postData('email'),
                'message'   => $request->postData('message')]
            );

            if ($message->getErrors() != null) {
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

    /**
     * Render the mentions légales page view
     */
    public function executeMentionsLegales()
    {
        $this->page->addVar('contentClass', 'content');
        $this->page->addVar('title', 'Mentions légales');
    }
}
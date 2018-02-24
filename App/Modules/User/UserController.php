<?php
namespace App\Modules\User;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\User;
use EmmaM\Session;

class UserController extends Controller
{
    public function executeListUsers()
    {
        $this->adminLayout();

        $this->page->addVar('title', 'Liste des utilisateurs');

        $users = $this->manager->getManagerOf('User')->getAllUsers();

        $this->page->addVar('users', $users);
    }

    public function executeRegister(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Inscription');
        $this->page->addVar('contentClass', 'content');

        if ($request->postExists('username')) {
            $errorMessage = '';
            // Pseudo unique
            if ($this->manager->getManagerOf('User')->getUserByUsername($request->postData('username')) != null) {
                $errorMessage .= 'Ce pseudo est déjà pris, merci d\'en choisir un autre.<br />';
            }
            // Email unique
            if ($this->manager->getManagerOf('User')->getUserByEmail($request->postData('email')) != null) {
                $errorMessage .= 'Un compte existe déjà avec cet email.<br />';
            }
            // Not same passwords
            if ($request->postData('password') != $request->postData('confirmPwd')) {
                $errorMessage .= 'Les deux mots de passe saisis ne sont pas identiques.<br />';
            }

            if (empty($errorMessage)) {
                $user = new User([
                    'username'  => $request->postData('username'),
                    'email'     => $request->postData('email'),
                    'password'  => password_hash($request->postData('password'), PASSWORD_BCRYPT)
                ]);

                if (($errors = $user->getErrors()) != null) {
                    $user->getErrorMessage();
                } else {
                    $userId = $this->manager->getManagerOf('User')->addUser($user);
                    Session::getInstance()->setFlash('success', 'Un email vous a été envoyé pour confirmer votre inscription.');
                }
            } else {
                Session::getInstance()->setFlash('danger', $errorMessage);
            }
        }
    }

    public function executeLogin(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Connexion');
        $this->page->addVar('contentClass', 'content');

        if ($request->postExists('username') && $request->postExists('password')) {
            $user = $this->manager->getManagerOf('User')->getUserByUsername($request->postData('username'));

            if ($user != null && password_verify($request->postData('password'), $user->getPassword()) && ($user->getRole() != 0)) {
                Session::getInstance()->setAttribute('auth', $user);
                Session::getInstance()->setFlash('success', 'Vous êtes maintenant connecté(e) !');
                $this->app->getHttpResponse()->redirect('/');
            } else {
                Session::getInstance()->setFlash('danger', 'Vos identifiants n\'ont pas été reconnus.');
            }
        }
    }

    public function executeLogout()
    {
        Session::getInstance()->setAttribute('auth', null);
        Session::getInstance()->setFlash('success', 'Vous êtes maintenant déconnecté(e) !');
        $this->app->getHttpResponse()->redirect('/');
    }

    public function executeSetRole(HTTPRequest $request)
    {
        $userRole = $request->getData('userRole');

        if ($userRole == 1) {
            $this->manager->getManagerOf('User')->updateRole($request->getData('userId'), 2);
        } elseif ($userRole == 2) {
            $this->manager->getManagerOf('User')->updateRole($request->getData('userId'), 1);
        } else {
            Session::getInstance()->setFlash('danger', 'Une erreur s\'est produite, veuillez réessayer.');
        }
        Session::getInstance()->setFlash('success', 'Le rôle de cet utilisateur a bien été modifié.');
        $this->app->getHttpResponse()->redirect('/admin/listUsers');
    }

    public function executeDeleteUser(HTTPRequest $request)
    {
        $this->manager->getManagerOf('User')->deleteUser($request->getData('id'));
        Session::getInstance()->setFlash('success', 'Cet utilisateur a bien été supprimé.');
        $this->app->getHttpResponse()->redirect('/admin/listUsers');
    }
}


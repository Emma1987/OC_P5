<?php
namespace App\Modules\User;

use EmmaM\Controller;
use EmmaM\HTTPRequest;
use Entity\User;

class UserController extends Controller
{
	public function executeRegister(HTTPRequest $request)
	{
		if ($request->postExists('username')) 
		{
			$errorMessage = '';
			// Pseudo unique
			if ($this->manager->getManagerOf('User')->getUserByUsername($request->postData('username')) != null)
			{
				$errorMessage .= 'Ce pseudo est déjà pris, merci d\'en choisir un autre.<br />';
			}
			// Email unique
			if ($this->manager->getManagerOf('User')->getUserByEmail($request->postData('email')) != null)
			{
				$errorMessage .= 'Un compte existe déjà avec cet email.<br />';
			}
			// Identiques passwords
			if ($request->postData('password') != $request->postData('confirmPwd'))
			{
				$errorMessage .= 'Les deux mots de passe saisis ne sont pas identiques.<br />';
			}

			if (empty($errorMessage))
			{
				$user = new User([
					'username'	=> $request->postData('username'),
					'email'		=> $request->postData('email'),
					'password'	=> password_hash($request->postData('password'), PASSWORD_BCRYPT)
				]);

				$userId = $this->manager->getManagerOf('User')->addUser($user);
			}
			else {
			 	return $errorMessage;
			}
		}
	}

	public function executeLogin(HTTPRequest $request)
	{
		if ($request->postExists('username') && $request->postExists('password'))
		{
			if ($user = $this->manager->getManagerOf('User')->getUserByUsername($request->postData('username')))
			{
				if (password_verify($request->postData('password'), $user->getPassword()) && ($user->getRole() != 0))
				{
					$this->app->getHttpResponse()->redirect('/');
				}
			}
			else {
				return $errorMessage = 'Vos identifiants n\'ont pas été reconnus';
			}
		}
	}

	public function executeLogout()
	{
		$this->app->getHttpResponse()->redirect('/');
	}

	public function executeListUsers()
	{
		$users = $this->manager->getManagerOf('User')->getAllUsers();

		$this->page->addVar('users', $users);
	}

	public function executeDeleteUser(HTTPRequest $request)
	{
		$this->manager->getManagerOf('User')->deleteUser($request->getData('id'));
		$this->app->getHttpResponse()->redirect('/listUsers');
	}
}


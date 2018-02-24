<?php
namespace Entity;

use EmmaM\Entity;

class User extends Entity
{
	protected $id;
	protected $username;
	protected $email;
	protected $password;
	protected $role = 0;

	const INVALID_USERNAME = 'Le nom d\'utilisateur doit être composé de 3 à 20 caractères alphanumériques.';
	const INVALID_EMAIL = 'L\'email saisis semble ne pas être valide.';
	const INVALID_PASSWORD = 'Le mot de passe doit contenir entre 8 et 20 caractères, et doit contenir au moins 1 lettre et 1 chiffre.';

	// GETTERS & SETTERS

	public function getId()
	{
		return $this->id;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function setUsername($username)
	{
		if (!preg_match('#^[a-zA-Z0-9].{3,20}$#', $username)) // + unique
		{
			$this->errors[] = self::INVALID_USERNAME;
		}
		else {
			$this->username = $username;
		}
	}

	public function setEmail($email)
	{
		if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) // + unique
		{
			$this->errors[] = self::INVALID_EMAIL;
		}
		else {
			$this->email = $email;
		}
	}

	public function setPassword($password)
	{
		if (!preg_match('#(?=.*[a-zA-Z])(?=.*[0-9\W]).{8,20}#', $password))
		{
			$this->errors[] = self::INVALID_PASSWORD;
		}
		else {
			$this->password = $password;
		}
	}

	public function setRole($role)
	{
		$this->role = $role;
	}
}

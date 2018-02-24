<?php
namespace Model;

use EmmaM\Manager;
use Entity\User;

class UserManager extends Manager
{
	public function getAllUsers()
	{
		$db = $this->getDbConnexion();

		$requete = $db->query('SELECT * FROM User');
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
		$users = $requete->fetchAll();

		return $users;
	}

	public function getUserById($id)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('SELECT * FROM User WHERE id = :id');
		$requete->bindValue(':id', $id);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
		$user = $requete->fetch();

		return $user;
	}

	public function getUserByUsername($username)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('SELECT * FROM User WHERE username = :username');
		$requete->bindValue(':username', $username);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
		$user = $requete->fetch();

		return $user;
	}

	public function getUserByEmail($email)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('SELECT * FROM User WHERE email = :email');
		$requete->bindValue(':email', $email);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
		$user = $requete->fetch();

		return $user;
	}

	public function addUser(User $user)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('INSERT INTO User (username, email, password, role) VALUES (:username, :email, :password, :role)');

		$requete->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $requete->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $requete->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $requete->bindValue(':role', $user->getRole(), \PDO::PARAM_INT);

		$requete->execute();

		return $userId = $db->lastInsertId();
	}

	public function deleteUser($userId)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('DELETE FROM User WHERE id = :id');
		$requete->bindValue(':id', $userId);

		$requete->execute();
	}
}
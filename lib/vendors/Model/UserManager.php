<?php
namespace Model;

use EmmaM\Manager;
use Entity\User;

class UserManager extends Manager
{
    public function getAllUsers()
    {
        $requete = $this->getDb()->query('SELECT * FROM User');
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $users = $requete->fetchAll();
    }

    public function getUserById($id)
    {
        $requete = $this->getDb()->prepare('SELECT * FROM User WHERE id = :id');
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $user = $requete->fetch();
    }

    public function getUserByUsername($username)
    {
        $requete = $this->getDb()->prepare('SELECT * FROM User WHERE username = :username');
        $requete->bindValue(':username', $username);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $user = $requete->fetch();
    }

    public function getUserByEmail($email)
    {
        $requete = $this->getDb()->prepare('SELECT * FROM User WHERE email = :email');
        $requete->bindValue(':email', $email);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        return $user = $requete->fetch();
    }

    public function countUsers()
    {
        $requete = $this->getDb()->query('SELECT COUNT(*) FROM User');
        return $userNumber = $requete->fetchColumn();
    }

    public function confirmAccount(User $user)
    {
        $requete = $this->getDb()->prepare('UPDATE User SET role = :role, token = :token WHERE id = :id');
        $requete->bindValue(':role', $user->getRole());
        $requete->bindValue(':token', $user->getToken());
        $requete->bindValue(':id', $user->getId());
        $requete->execute();
    }

    public function addUser(User $user)
    {
        $requete = $this->getDb()->prepare(
            'INSERT INTO User (username, email, password, token, role) 
            VALUES (:username, :email, :password, :token, :role)'
        );

        $requete->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $requete->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $requete->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $requete->bindValue(':token', $user->getToken(), \PDO::PARAM_STR);
        $requete->bindValue(':role', $user->getRole(), \PDO::PARAM_INT);

        $requete->execute();
    }

    public function updateToken($token, $userId, $resetAt)
    {
        $requete = $this->getDb()->prepare('UPDATE User SET token = :token, resetAt = :resetAt WHERE id = :id');

        $requete->bindValue(':token', $token);
        $requete->bindValue(':resetAt', $resetAt);
        $requete->bindValue(':id', $userId);

        $requete->execute();
    }

    public function updatePassword(User $user)
    {
        $requete = $this->getDb()->prepare('UPDATE User SET token = :token, password = :password WHERE id = :id');
        $requete->bindValue(':token', $user->getToken());
        $requete->bindValue(':password', $user->getPassword());
        $requete->bindValue(':id', $user->getId());
        $requete->execute();
    }

    public function updateRole($userId, $newRole)
    {
        $requete = $this->getDb()->prepare('UPDATE User SET role = :role WHERE id = :id');
        $requete->bindValue(':id', $userId, \PDO::PARAM_INT);
        $requete->bindValue(':role', $newRole, \PDO::PARAM_INT);
        $requete->execute();
    }

    public function deleteUser($userId)
    {
        $requete = $this->getDb()->prepare('DELETE FROM User WHERE id = :id');
        $requete->bindValue(':id', $userId);
        $requete->execute();
    }
}
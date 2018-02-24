<?php
namespace Entity;

use EmmaM\Entity;
use EmmaM\Mailer;

class User extends Entity
{
    use Mailer;

    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $token;
    protected $resetAt;
    protected $role = 0;

    const INVALID_USERNAME = 'Le nom d\'utilisateur doit être composé de 3 à 20 caractères alphanumériques.';
    const INVALID_EMAIL = 'L\'email saisis semble ne pas être valide.';
    const INVALID_PASSWORD = 'Le mot de passe doit être composé de 8 et 20 caractères, et doit contenir au moins 1 lettre majuscule, 1 lettre minuscule et 1 chiffre.';

    public function createToken()
    {
        $char = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';
        $token = substr(str_shuffle(str_repeat($char, 50)), 0, 50);

        $this->token = $token;
    }

    public function confirmAccount($sendFrom, $validateLink, $sendTo)
    {
        $subject = 'Confirmez votre compte';
        $body = '<p>Merci de cliquer sur le lien suivant pour valider votre compte :</p>' . $validateLink . '';

        $this->sendMail($sendFrom, 'Administrateur', $subject, $body, $sendTo, $sendFrom);
    }

    public function resetPassword($sendFrom, $validateLink, $sendTo)
    {
        $subject = 'Réinitialisez votre mot de passe';
        $body = '<p>Merci de cliquer sur le lien suivant pour réinitialiser votre mot de passe :</p>' . $validateLink . '';

        $this->sendMail($sendFrom, 'Administrateur', $subject, $body, $sendTo, $sendFrom);
    }

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

    public function getToken()
    {
        return $this->token;
    }

    public function getResetAt()
    {
        return $this->resetAt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setUsername($username)
    {
        if (!preg_match('#^[a-zA-Z0-9].{3,20}$#', $username)) {
            $this->errors[] = self::INVALID_USERNAME;
        } else {
            $this->username = $username;
        }
    }

    public function setEmail($email)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = self::INVALID_EMAIL;
        } else {
            $this->email = $email;
        }
    }

    public function setPassword($password)
    {
        if (!preg_match('#(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,20}#', $password)) {
            $this->errors[] = self::INVALID_PASSWORD;
        } else {
            $this->password = $password;
        }
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setResetAt($resetAt)
    {
        $this->resetAt = $resetAt;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}

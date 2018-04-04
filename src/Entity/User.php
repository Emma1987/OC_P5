<?php

namespace Entity;

use App\Entity;
use App\Mailer;

/**
 * User
 */
class User extends Entity
{
    use Mailer;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var datetime
     */
    protected $resetAt;

    /**
     * @var integer
     */
    protected $role = 0;

    const INVALID_USERNAME = 'Le nom d\'utilisateur doit être composé de 3 à 30 caractères alphanumériques.';
    const INVALID_EMAIL = 'L\'email saisis semble ne pas être valide.';
    const INVALID_PASSWORD = 'Le mot de passe doit être composé de 8 et 20 caractères, et doit contenir au moins 1 lettre majuscule, 1 lettre minuscule et 1 chiffre.';

    /**
     * Create a token to validate account or reset password
     * @return string
     */
    public function createToken()
    {
        $char = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';
        $token = substr(str_shuffle(str_repeat($char, 50)), 0, 50);

        $this->token = $token;
    }

    /**
     * Send mail to validate account
     * @param  string $sendFrom     [The address who sends the email]
     * @param  string $validateLink [The link to validate the account]
     * @param  string $sendTo       [The mail of the new user]
     */
    public function confirmAccount($sendFrom, $validateLink, $sendTo)
    {
        $subject = 'Confirmez votre compte';
        $body = '<p>Merci de cliquer sur le lien suivant pour valider votre compte :</p>' . $validateLink . '';

        $this->sendMail($sendFrom, 'Administrateur', $subject, $body, $sendTo, $sendFrom);
    }

    /**
     * Send mail to reset password
     * @param  string $sendFrom     [The address who sends the email]
     * @param  string $validateLink [The link to reset the password]
     * @param  string $sendTo       [The mail of the user]
     */
    public function resetPassword($sendFrom, $validateLink, $sendTo)
    {
        $subject = 'Réinitialisez votre mot de passe';
        $body = '<p>Merci de cliquer sur le lien suivant pour réinitialiser votre mot de passe :</p>' . $validateLink . '';

        $this->sendMail($sendFrom, 'Administrateur', $subject, $body, $sendTo, $sendFrom);
    }

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get password
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get token
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get the datetime the email was send
     * @return datetime
     */
    public function getResetAt()
    {
        return $this->resetAt;
    }

    /**
     * Get user role
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set username
     * @param string $username
     */
    public function setUsername($username)
    {
        if (!preg_match('#^[a-zA-Z0-9].{3,30}$#', $username)) {
            $this->errors[] = self::INVALID_USERNAME;
        } else {
            $this->username = $username;
        }
    }

    /**
     * Set email
     * @param string $email
     */
    public function setEmail($email)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = self::INVALID_EMAIL;
        } else {
            $this->email = $email;
        }
    }

    /**
     * Set password
     * @param string $password
     */
    public function setPassword($password)
    {
        if (!preg_match('#(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,20}#', $password)) {
            $this->errors[] = self::INVALID_PASSWORD;
        } else {
            $this->password = $password;
        }
    }

    /**
     * Set token
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Set the datetime the email was send
     * @param datetime $resetAt
     */
    public function setResetAt($resetAt)
    {
        $this->resetAt = $resetAt;
    }

    /**
     * Set user role
     * @param int $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
}

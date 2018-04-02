<?php

namespace App;

use App\Entity;
use App\Mailer;

class ContactForm extends Entity
{
    use Mailer;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $message;

    const INVALID_FIRSTNAME = 'Votre nom doit être composé de 3 à 20 caractères alphanumériques.';
    const INVALID_LASTNAME = 'Votre prénom doit être composé de 3 à 20 caractères alphanumériques.';
    const INVALID_EMAIL = 'L\'email saisis semble ne pas être valide.';
    const INVALID_MESSAGE = 'Votre message doit comporter au minimum 15 caractères.';

    /**
     * Send the message
     * @param  string $sendTo [The address to send the mail]
     */
    public function sendContactMessage($sendTo)
    {
        $subject = htmlspecialchars($this->getLastname()).' '.htmlspecialchars($this->getFirstname()).' vous a envoyé un message !';
        $body = "Un nouveau message vous a été envoyé depuis le formulaire de contact. " . "Voici les détails :\nExpéditeur : " . htmlspecialchars($this->getLastname()) . " " . htmlspecialchars($this->getFirstname()) . "\n\nEmail :\n" . htmlspecialchars($this->getEmail()) . "\n\nMessage :\n " . nl2br(htmlspecialchars($this->getMessage()));

        $this->sendMail(
            $this->getEmail(), 
            $this->getFirstname() . ' ' . $this->getLastname(),
            $subject,
            $body,
            $sendTo,
            $this->getEmail()
        );
    }

    /**
     * Get firstname
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get lastname
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
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
     * Get message
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set firstname
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        if (!preg_match('#^[a-zA-Z0-9].{3,20}$#', $firstname)) {
            $this->errors[] = self::INVALID_FIRSTNAME;
        } else {
            $this->firstname = $firstname;
        }
    }

    /**
     * Set lastname
     * @param string $lastname
     */
    public function setLastName($lastname)
    {
        if (!preg_match('#^[a-zA-Z0-9].{3,20}$#', $lastname)) {
            $this->errors[] = self::INVALID_LASTNAME;
        } else {
            $this->lastname = $lastname;
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
     * Set message
     * @param string $message
     */
    public function setMessage($message)
    {
        if (!preg_match('#^[a-zA-Z0-9].{15,}$#', $message)) {
            $this->errors[] = self::INVALID_MESSAGE;
        } else {
            $this->message = $message;
        }
    }
}
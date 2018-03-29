<?php

namespace App;

use App\Entity;
use App\Mailer;

class ContactForm extends Entity
{
    use Mailer;

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $message;

    const INVALID_FIRSTNAME = 'Votre nom doit être composé de 3 à 20 caractères alphanumériques.';
    const INVALID_LASTNAME = 'Votre prénom doit être composé de 3 à 20 caractères alphanumériques.';
    const INVALID_EMAIL = 'L\'email saisis semble ne pas être valide.';
    const INVALID_MESSAGE = 'Votre message doit comporter au minimum 15 caractères.';

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

    // GETTERS & SETTERS

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setFirstname($firstname)
    {
        if (!preg_match('#^[a-zA-Z0-9].{3,20}$#', $firstname)) {
            $this->errors[] = self::INVALID_FIRSTNAME;
        } else {
            $this->firstname = $firstname;
        }
    }

    public function setLastName($lastname)
    {
        if (!preg_match('#^[a-zA-Z0-9].{3,20}$#', $lastname)) {
            $this->errors[] = self::INVALID_LASTNAME;
        } else {
            $this->lastname = $lastname;
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

    public function setMessage($message)
    {
        if (!preg_match('#^[a-zA-Z0-9].{15,}$#', $message)) {
            $this->errors[] = self::INVALID_MESSAGE;
        } else {
            $this->message = $message;
        }
    }
}
<?php

namespace Entity;

use App\Entity;
use App\Mailer;

class Comment extends Entity
{
    use Mailer;

    protected $id;
    protected $author;
    protected $commentContent;
    protected $commentDate;
    protected $postId;
    protected $userId;
    protected $online = false;

    const INVALID_CONTENT = 'Le commentaire ne peut être vide, et doit contenir au moins 10 caractères.';
    const INVALID_POSTID = 'L\'id de l\'article est invalide';
    const INVALID_ONLINE = 'L\'attribut online n\'a pas pu être modifié.';

    public function mailNewComment($sendTo)
    {
        $subject = 'Nouveau commentaire sur votre site !';
        $body = 'Un nouveau commentaire a été posté sur votre site. Vous pouvez dès à présent le valider !';

        $this->sendMail($sendTo, 'Administrateur', $subject, $body, $sendTo, $sendTo);
    }

    // GETTERS & SETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getCommentContent()
    {
        return $this->commentContent;
    }

    public function getCommentDate()
    {
        return $this->commentDate;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getOnline()
    {
        return $this->online;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setCommentContent($commentContent)
    {
        if (empty($commentContent) || !is_string($commentContent) || strlen($commentContent) < 10) {
            $this->errors[] = self::INVALID_CONTENT;
        } else {
            $this->commentContent = $commentContent;
        }
    }

    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;
    }

    public function setPostId($postId)
    {
        if (empty($postId)) {
            $this->errors[] = self::INVALID_POSTID;
        } else {
            $this->postId = $postId;
        }
    }

    public function setOnline($online)
    {
        if (!is_bool($online)) {
            $this->errors[] = self::INVALID_ONLINE;
        } else {
            $this->online = $online;
        }
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
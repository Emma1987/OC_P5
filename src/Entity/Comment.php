<?php

namespace Entity;

use App\Entity;
use App\Mailer;

/**
 * Comment
 */
class Comment extends Entity
{
    use Mailer;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $commentContent;

    /**
     * @var datetime
     */
    protected $commentDate;

    /**
     * @var int
     */
    protected $postId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var boolean
     */
    protected $online = false;

    const INVALID_CONTENT = 'Le commentaire ne peut être vide, et doit contenir au moins 10 caractères.';
    const INVALID_POSTID = 'L\'id de l\'article est invalide';
    const INVALID_ONLINE = 'L\'attribut online n\'a pas pu être modifié.';

    /**
     * Send a mail when new comment is posted
     * @param  string $sendTo [The address who sends the mail]
     */
    public function mailNewComment($sendTo)
    {
        $subject = 'Nouveau commentaire sur votre site !';
        $body = 'Un nouveau commentaire a été posté sur votre site. Vous pouvez dès à présent le valider !';

        $this->sendMail($sendTo, 'Administrateur', $subject, $body, $sendTo, $sendTo);
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
     * Get author
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get comment content
     * @return string
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * Get comment published date
     * @return datetime
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * Get the associated post id
     * @return int
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Get the published status of comment
     * @return boolean
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Get the author id
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set author
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Set comment content
     * @param string $commentContent
     */
    public function setCommentContent($commentContent)
    {
        if (empty($commentContent) || !is_string($commentContent) || strlen($commentContent) < 10) {
            $this->errors[] = self::INVALID_CONTENT;
        } else {
            $this->commentContent = $commentContent;
        }
    }

    /**
     * Set comment date
     * @param datetime $commentDate
     */
    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;
    }

    /**
     * Set Post id
     * @param int $postId
     */
    public function setPostId($postId)
    {
        if (empty($postId)) {
            $this->errors[] = self::INVALID_POSTID;
        } else {
            $this->postId = $postId;
        }
    }

    /**
     * Set online
     * @param boolean $online
     */
    public function setOnline($online)
    {
        if (!is_bool($online)) {
            $this->errors[] = self::INVALID_ONLINE;
        } else {
            $this->online = $online;
        }
    }

    /**
     * Set User id
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
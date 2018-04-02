<?php

namespace Entity;

use App\Entity;

/**
 * Post
 */
class Post extends Entity
{
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
    protected $title;

    /**
     * @var string
     */
    protected $preface;

    /**
     * @var string
     */
    protected $postContent;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var datetime
     */
    protected $publishedAt;

    /**
     * @var datetime
     */
    protected $updatedAt;

    /**
     * @var int
     */
    protected $userId;

    const INVALID_AUTHOR = 'Le nom de l\'auteur doit être composé de 3 à 30 caractères alphanumériques.';
    const INVALID_TITLE = 'Le titre de votre article doit être une chaine de caractères de 10 à 100 caractères.';
    const INVALID_PREFACE = 'La présentation de votre article doit être une chaine de caractères de 10 à 255 caractères.';
    const INVALID_CONTENT = 'Le contenu de votre article doit faire au minimum 10 caractères.';
    const INVALID_LINK = 'Le lien entré semble ne pas être une URL correcte.';

    /**
     * Get the most recent date
     * @return datetime [The updated date if defined, or the published date]
     */
    public function getLastDate()
    {
        if (!empty($this->updatedAt)) {
            return $this->getUpdatedAt();
        } else {
            return $this->getPublishedAt();
        }
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
     * Get title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get preface
     * @return string
     */
    public function getPreface()
    {
        return $this->preface;
    }

    /**
     * Get post content
     * @return string
     */
    public function getPostContent()
    {
        return $this->postContent;
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
     * Get link
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Get publication date
     * @return datetime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Get update date
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get user id
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
        if (!is_string($author) || !preg_match('#^[a-zA-Z0-9].{3,30}$#', $author)) {
            $this->errors[] = self::INVALID_AUTHOR;
        } else {
            $this->author = $author;
        }
    }

    /**
     * Set title
     * @param string $title
     */
    public function setTitle($title)
    {
        if (!is_string($title) || !preg_match('#^[a-zA-Z0-9].{10,100}$#', $title)) {
            $this->errors[] = self::INVALID_TITLE;
        } else {
            $this->title = $title;
        }   
    }

    /**
     * Set preface
     * @param string $preface
     */
    public function setPreface($preface)
    {
        if (!is_string($preface) || !preg_match('#^[a-zA-Z0-9].{10,255}$#', $preface)) {
            $this->errors[] = self::INVALID_PREFACE;
        } else {
            $this->preface = $preface;
        }
    }

    /**
     * Set post content
     * @param string $postContent
     */
    public function setPostContent($postContent)
    {
        if (!is_string($postContent) || !preg_match('#^[a-zA-Z0-9].{10,}$#', $postContent)) {
            $this->errors[] = self::INVALID_CONTENT;
        } else {
            $this->postContent = $postContent;
        }
    }

    /**
     * Set link
     * @param string $link
     */
    public function setLink($link)
    {
        if (!is_string($link) || !preg_match('#^[a-zA-Z0-9:\./].{15,100}$#', $link)) {
            $this->errors[] = self::INVALID_LINK;
        } else {
            $this->link = $link;
        }
    }

    /**
     * Set publication date
     * @param datetime $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * Set update date
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
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
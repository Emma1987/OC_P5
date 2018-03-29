<?php

namespace Entity;

use App\Entity;

class Post extends Entity
{
    protected $id;
    protected $author;  
    protected $title;
    protected $preface;
    protected $postContent;
    protected $link;
    protected $publishedAt;
    protected $updatedAt;

    const INVALID_AUTHOR = 'Le nom de l\'auteur doit être composé de 3 à 20 caractères alphanumériques.';
    const INVALID_TITLE = 'Le titre de votre article doit être une chaine de caractères de 15 à 255 caractères.';
    const INVALID_PREFACE = 'La présentation de votre article doit être une chaine de caractères de 15 à 255 caractères.';
    const INVALID_CONTENT = 'Le contenu de votre article doit faire au minimum 15 caractères.';
    const INVALID_LINK = 'Le lien entré semble ne pas être une URL correcte.';

    public function getLastDate()
    {
        if (!empty($this->updatedAt)) {
            return $this->getUpdatedAt();
        } else {
            return $this->getPublishedAt();
        }
    }

    //GETTERS & SETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPreface()
    {
        return $this->preface;
    }

    public function getPostContent()
    {
        return $this->postContent;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setAuthor($author)
    {
        if (!is_string($author) || !preg_match('#^[a-zA-Z0-9].{3,20}$#', $author)) {
            $this->errors[] = self::INVALID_AUTHOR;
        } else {
            $this->author = $author;
        }
    }

    public function setTitle($title)
    {
        if (!is_string($title) || !preg_match('#^[a-zA-Z0-9].{0,255}$#', $title)) {
            $this->errors[] = self::INVALID_TITLE;
        } else {
            $this->title = $title;
        }   
    }

    public function setPreface($preface)
    {
        if (!is_string($preface) || !preg_match('#^[a-zA-Z0-9].{15,255}$#', $preface)) {
            $this->errors[] = self::INVALID_PREFACE;
        } else {
            $this->preface = $preface;
        }
    }

    public function setPostContent($postContent)
    {
        if (!is_string($postContent) || !preg_match('#^[a-zA-Z0-9].{15,}$#', $postContent)) {
            $this->errors[] = self::INVALID_CONTENT;
        } else {
            $this->postContent = $postContent;
        }
    }

    public function setLink($link)
    {
        if (!is_string($link) || !preg_match('#^[a-zA-Z0-9:\./].{15,100}$#', $link)) {
            $this->errors[] = self::INVALID_LINK;
        } else {
            $this->link = $link;
        }
    }

    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}
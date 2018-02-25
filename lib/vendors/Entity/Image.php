<?php
namespace Entity;

use EmmaM\Entity;
use Imagine\Image\ImageInterface;

class Image extends Entity
{
    protected $id;
    protected $tmpName;
    protected $title;   
    protected $extension;
    protected $size;
    protected $url;
    protected $postId;

    const INVALID_TITLE = 'Le titre de l\'image doit être une chaine de caractères de 10 à 100 caractères.';
    const INVALID_SIZE = 'La taille de l\'image doit être inférieur à 2Mo.';
    const INVALID_EXT = 'L\'image doit être au format JPG, JPEG, ou PNG.';

    public function saveAndResize()
    {
        $imagine = new \Imagine\Gd\Imagine();
                    
        $newImage = $imagine->open($this->getTmpName());

        $imageSize = $newImage->getSize();
        $ratio = 600 / $imageSize->getWidth();
        $width = $imageSize->getWidth() * $ratio;
        $height = $imageSize->getHeight()* $ratio;

        $options = array(
            'jpeg_quality' => 100,
            'png_compression' => 9);

        $newImage->resize(new \Imagine\Image\Box($width, $height))
            ->save(__DIR__ . '/../../../Web/uploads/img/' . $this->getTitle() . $this->getPostId() . '.' . $this->getExtension(), $options);
    }

    // GETTERS & SETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getTmpName()
    {
        return $this->tmpName;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setTmpName($tmpName)
    {
        $this->tmpName = $tmpName;
    }

    public function setTitle($title)
    {
        if (is_string($title) && !empty($title) && strlen($title) > 10 && strlen($title) < 100) {
            $this->title = $title;
        } else {
            $this->errors[] = self::INVALID_TITLE;
        }
    }

    public function setExtension($extension)
    {
        if ($extension == "jpg" || $extension == "png" || $extension == "jpeg") {
            $this->extension = $extension;  
        } else {
            $this->errors[] = self::INVALID_EXT;
        }
    }

    public function setSize($size)
    {
        if (!empty($size) && $size < 2097152) {
            $this->size = $size;
        } else {
            $this->errors[] = self::INVALID_SIZE;
        }
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }
}
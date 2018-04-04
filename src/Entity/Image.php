<?php

namespace Entity;

use App\Entity;
use Imagine\Image\ImageInterface;

/**
 * Image
 */
class Image extends Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $tmpName;

    /**
     * @var string
     */
    protected $title; 

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $postId;

    const INVALID_TITLE = 'Le titre de l\'image doit être une chaine de caractères de 5 à 100 caractères.';
    const INVALID_SIZE = 'La taille de l\'image doit être inférieur à 2Mo.';
    const INVALID_EXT = 'L\'image doit être au format JPG, JPEG, ou PNG.';

    /**
     * Resize an image and move it in the uploads folder
     */
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
            ->save(__DIR__ . '/../../Web/uploads/img/' . $this->getTitle() . $this->getPostId() . '.' . $this->getExtension(), $options);
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
     * Get temporary name
     * @return string
     */
    public function getTmpName()
    {
        return $this->tmpName;
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
     * Get image extension
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Get image size
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get url
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get associated post id
     * @return int
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set temporary name
     * @param string $tmpName
     */
    public function setTmpName($tmpName)
    {
        $this->tmpName = $tmpName;
    }

    /**
     * Set title
     * @param string $title
     */
    public function setTitle($title)
    {
        if (is_string($title) && !empty($title) && strlen($title) > 5 && strlen($title) < 100) {
            $this->title = $title;
        } else {
            $this->errors[] = self::INVALID_TITLE;
        }
    }

    /**
     * Set extension
     * @param string $extension
     */
    public function setExtension($extension)
    {
        if ($extension == "jpg" || $extension == "png" || $extension == "jpeg") {
            $this->extension = $extension;  
        } else {
            $this->errors[] = self::INVALID_EXT;
        }
    }

    /**
     * Set image size
     * @param int $size
     */
    public function setSize($size)
    {
        if (!empty($size) && $size < 2097152) {
            $this->size = $size;
        } else {
            $this->errors[] = self::INVALID_SIZE;
        }
    }

    /**
     * Set url
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Set associated post id
     * @param int $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }
}
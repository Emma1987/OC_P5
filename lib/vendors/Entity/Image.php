<?php
namespace Entity;

use EmmaM\Entity;

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

	public function save()
	{
		$target_file = __DIR__ . '/../../../Web/uploads/img/' . $this->getTitle();
		$target_name = $this->getTmpName();
		$uploadOk = 1;

		if (file_exists($target_file))
		{
			$this->errors[] = self::INVALID_NAME;
			$uploadOk = 0;
		}

		if ($this->getSize() > 500000)
		{
			$this->errors[] = self::INVALID_SIZE;
			$uploadOk = 0;
		}

		if($this->getExtension() != "image/jpg" && $this->getExtension() != "image/png" && $this->getExtension() != "image/jpeg")
		{
			$this->errors[] = self::INVALID_EXT;
			$uploadOk = 0;
		}

		if ($uploadOk != 0)
		{
			move_uploaded_file($target_name, $target_file);
		}
		else {
			$this->errors[] = self::INVALID_ERROR;
		}
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
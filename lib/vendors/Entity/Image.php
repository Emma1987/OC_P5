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

	const INVALID_NAME = 1;
	const INVALID_SIZE = 2;
	const INVALID_EXT = 3;
	const INVALID_ERROR = 4;

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
		$this->title = $title;
	}

	public function setExtension($extension)
	{
		$this->extension = $extension;
	}

	public function setSize($size)
	{
		$this->size = $size;
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
<?php
namespace Entity;

use EmmaM\Entity;

class Post extends Entity
{
	protected $id;
	protected $author;	
	protected $title;
	protected $preface;
	protected $postContent;
	protected $publishedAt;
	protected $updatedAt;

	const INVALID_AUTHOR = 1;
	const INVALID_TITLE = 2;
	const INVALID_PREFACE = 3;
	const INVALID_CONTENT = 4;	

	public function getLastDate()
	{
		if (!empty($this->updatedAt))
		{
			return $this->getUpdatedAt();
		}
		else {
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
		if (is_string($author) && !empty($author))
		{
			$this->author = $author;
		}
		else {
			$this->errors[] = self::INVALID_AUTHOR;
		}
	}

	public function setTitle($title)
	{
		if (is_string($title) && !empty($title))
		{
			$this->title = $title;
		}
		else {
			$this->errors[] = self::INVALID_TITLE;
		}	
	}

	public function setPreface($preface)
	{
		if (is_string($preface) && !empty($preface))
		{
			$this->preface = $preface;
		}
		else {
			$this->errors[] = self::INVALID_PREFACE;
		}
	}

	public function setPostContent($postContent)
	{
		if (is_string($postContent) && !empty($postContent))
		{
			$this->postContent = $postContent;
		}
		else {
			$this->errors[] = self::INVALID_CONTENT;
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
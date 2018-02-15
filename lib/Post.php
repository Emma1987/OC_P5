<?php

class Post
{
	protected $id;
	protected $author;	
	protected $title;
	protected $preface;
	protected $postContent;
	protected $publishedAt;
	protected $updatedAt;

	public function __construct(array $donnees = null)
	{
		if (!empty($donnees))
		{
			$this->hydrate($donnees);
		}
	}

	private function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set' . ucfirst($key);

			if (is_callable([$this, $method]))
			{
				$this->$method($value);
			}
		}
	}

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
			throw new \InvalidArgumentException('Le nom de l\'auteur doit être une chaine de caractères non nulle.');
		}
		
	}

	public function setTitle($title)
	{
		if (is_string($title) && !empty($title))
		{
			$this->title = $title;
		}
		else {
			throw new \InvalidArgumentException('Le titre doit être une chaine de caractères non nulle.');
		}	
	}

	public function setPreface($preface)
	{
		if (is_string($preface) && !empty($preface))
		{
			$this->preface = $preface;
		}
		else {
			throw new \InvalidArgumentException('La présentation de l\'article doit être une chaine de caractères non nulle.');
		}
	}

	public function setPostContent($postContent)
	{
		if (is_string($postContent) && !empty($postContent))
		{
			$this->postContent = $postContent;
		}
		else {
			throw new \InvalidArgumentException('Le contenu de l\'article doit être une chaine de caractères non nulle.');
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
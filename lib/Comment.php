<?php

class Comment
{
	protected $id;
	protected $author;
	protected $commentContent;
	protected $commentDate;
	protected $postId;
	protected $online = 0;

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

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function setCommentContent($commentContent)
	{
		$this->commentContent = $commentContent;
	}

	public function setCommentDate($commentDate)
	{
		$this->commentDate = $commentDate;
	}

	public function setPostId($postId)
	{
		$this->postId = $postId;
	}

	public function setOnline($online)
	{
		$this->online = $online;
	}
}
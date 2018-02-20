<?php
namespace Entity;

use EmmaM\Entity;

class Category extends Entity
{
	protected $id;
	protected $name;

	// GETTERS & SETTERS

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		if (is_string($name) && !empty($name))
		{
			$this->name = $name;
		}
		else {
			throw new \InvalidArgumentException('Le nom de la catégorie doit être une chaine de caractères non nulle.');
		}
	}
}
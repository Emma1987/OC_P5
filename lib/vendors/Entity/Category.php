<?php
namespace Entity;

use EmmaM\Entity;

class Category extends Entity
{
    protected $id;
    protected $name;

    const INVALID_NAME = 'Le nom de la catégorie doit être une chaine de caractères de 2 à 20 caractères.';

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
        if (is_string($name) && !empty($name) && strlen($name) > 2 && strlen($name) < 20) {
            $this->name = $name;
        } else {
            $this->errors[] = self::INVALID_NAME;
        }
    }
}
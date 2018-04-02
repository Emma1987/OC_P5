<?php

namespace Entity;

use App\Entity;

/**
 * Category
 */
class Category extends Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    const INVALID_NAME = 'Le nom de la catégorie doit être une chaine de caractères de 2 à 20 caractères.';

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     * @param string $name
     */
    public function setName($name)
    {
        if (is_string($name) && !empty($name) && strlen($name) > 2 && strlen($name) < 20) {
            $this->name = $name;
        } else {
            $this->errors[] = self::INVALID_NAME;
        }
    }
}
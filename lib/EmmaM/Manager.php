<?php
namespace EmmaM;

class Manager
{
    protected $db;

    public function __construct()
    {
        try {
            $this->setDb(new \PDO('mysql:host=localhost;dbname=blogperso;charset=utf8', 'root', 'root'));
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }   
    }

    public function getManagerOf($module)
    {
        if (!is_string($module) || empty($module)) {
            throw new \InvalidArgumentException('Le module spécifié est invalide');
        }

        if (!isset($this->manager[$module])) {
            $manager = '\\Model\\' . $module . 'Manager';
            $this->manager[$module] = new $manager();
        }
        return $this->manager[$module];
    }

    public function lastInsertId()
    {
        return $this->getDb()->lastInsertId();
    }

    // GETTERS & SETTERS

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }
}
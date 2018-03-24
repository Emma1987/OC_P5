<?php
namespace EmmaM;

class Manager
{
    protected $db;

    public function __construct()
    {
        $config = new Config();
        $host = $config->getConfig('host');
        $dbname = $config->getConfig('databaseName');
        $user = $config->getConfig('user');
        $pass = $config->getConfig('password');

        try {
            $this->setDb(new \PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass));
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
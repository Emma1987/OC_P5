<?php

namespace App;

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

    /**
     * Return the manager to call
     * @param  string $module
     */
    public function getManagerOf($module)
    {
        if (!is_string($module) || empty($module)) {
            throw new \InvalidArgumentException('Le module spécifié est invalide');
        }

        if (!isset($this->manager[$module])) {
            $manager = '\\Manager\\' . $module . 'Manager';
            $this->manager[$module] = new $manager();
        }
        return $this->manager[$module];
    }

    /**
     * Get the last insert id in database
     */
    public function lastInsertId()
    {
        return $this->getDb()->lastInsertId();
    }

    /**
     * Get the connection to the database
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the connection to the database
     */
    public function setDb($db)
    {
        $this->db = $db;
    }
}
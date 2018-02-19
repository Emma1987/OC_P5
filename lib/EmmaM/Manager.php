<?php
namespace EmmaM;

class Manager
{
	public function getDbConnexion()
	{
		try
		{
			$db = new \PDO('mysql:host=localhost;dbname=blogperso;charset=utf8', 'root', 'root');
			return $db;
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}	
	}

	public function getManagerOf($module)
	{
		if (!is_string($module) || empty($module))
		{
			throw new \InvalidArgumentException('Le module spécifié est invalide');
		}

		if (!isset($this->manager[$module]))
		{
			$manager = '\\Model\\' . $module . 'Manager';
			$this->manager[$module] = new $manager();
		}

		return $this->manager[$module];
	}
}
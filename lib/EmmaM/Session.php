<?php
namespace EmmaM;

class Session
{
	static $instance;

	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = new Session();
		}

		return self::$instance;
	}

	public function __construct()
	{
		session_start();
	}

	public function isActive()
	{
		return isset(self::$instance);
	}

	public function setFlash($key, $value)
	{
		$_SESSION['flash'][$key] = $value;
	}

	public function hasFlashes()
	{
	 	return isset($_SESSION['flash']);
	}

	public function getFlash()
	{
		$flash = $_SESSION['flash'];
		unset($_SESSION['flash']);
		return $flash;
	}

	public function getAttribute($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}

	public function setAttribute($key, $value)
	{
		$_SESSION[$key] = $value;
	}
}

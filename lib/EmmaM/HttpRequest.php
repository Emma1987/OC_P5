<?php
namespace EmmaM;

class HttpRequest
{
	public function getData($key)
	{
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}

	public function postData($key)
	{
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}

	public function postExists($key)
	{
		return !empty($_POST[$key]);
	}

	public function getMethod()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public function getRequestURI()
	{
		return $_SERVER['REQUEST_URI'];
	}
}
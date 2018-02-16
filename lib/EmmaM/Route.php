<?php
namespace EmmaM;

class Route
{
	protected $action;
	protected $module;
	protected $url;
	protected $varsNames;
	protected $vars = [];

	public function __construct($url, $module, $action, array $varsNames)
	{
		$this->setAction($action);
		$this->setModule($module);
		$this->setUrl($url);
		$this->setVarsNames($varsNames);
	}

	public function hasVars()
	{
		return !empty($this->getVarsNames());
	}

	public function match($url)
	{
		if (preg_match('#^'.$this->getUrl().'$#', $url, $matches))
		{
			return $matches;
		}
		else {
			return false;
		}
	}

	// GETTERS & SETTERS

	public function getAction()
	{
		return $this->action;
	}

	public function getModule()
	{
		return $this->module;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getVarsNames()
	{
		return $this->varsNames;
	}

	public function getVars()
	{
		return $this->vars;
	}

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function setModule($module)
	{
		$this->module = $module;
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function setVarsNames(array $varsNames)
	{
		$this->varsNames = $varsNames;
	}

	public function setVars(array $vars)
	{
		$this->vars = $vars;
	}
}
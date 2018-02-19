<?php
namespace EmmaM;

class Controller
{
	protected $app;
	protected $action = '';
	protected $module = '';
	protected $page = null;
	protected $view = '';
	protected $manager = null;

	public function __construct(Application $app, $module, $action)
	{
		$this->app = $app;
		$this->page = new Page();
		$this->manager = new Manager();

		$this->setAction($action);
		$this->setModule($module);
		$this->setView($action);
	}

	public function execute()
	{
		$method = 'execute' . ucfirst($this->getAction());

		if (!is_callable([$this, $method]))
		{
			throw new \RuntimeException('L\'action "' . $this->action . '" n\'est pas définie sur ce module');
		}

		$this->$method($this->app->getHttpRequest());
	}

	public function setView($view)
	{
		if (!is_string($view) || empty($view))
		{
			throw new \InvalidArgumentException('La vue doit être une chaine de caractères non nulle.');
		}

		$this->view = $view;
		$this->page->setContentFile(__DIR__ . '/../../App/Modules/' . $this->module . '/Views/' . $this->view . 'View.php');
	}

	// GETTERS & SETTERS
	
	public function getApp()
	{
		return $this->app;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getModule()
	{
		return $this->module;
	}

	public function getPage()
	{
		return $this->page;
	}

	public function getManager()
	{
		return $this->manager;
	}

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function setModule($module)
	{
		$this->module = $module;
	}
}
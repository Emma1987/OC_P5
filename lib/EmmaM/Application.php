<?php
namespace EmmaM;

class Application
{
	protected $httpRequest;
	protected $httpResponse;

	public function __construct()
	{
		$this->httpRequest = new HttpRequest();
		$this->httpResponse = new HttpResponse();
	}

	public function getController()
	{
		$router = new Router();

		$xml = new \DOMDocument();
		$xml->load(__DIR__ . '/../../App/Config/routes.xml');

		$routes = $xml->getElementsByTagName('route');

		foreach ($routes as $route)
		{
			$vars = [];
			if ($route->hasAttribute('vars'))
			{
				$vars = explode(',', $route->getAttribute('vars'));
			}

			$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
		}

		try
		{
			$matchedRoute = $router->getRoute($this->httpRequest->getRequestURI());
		}
		catch (\RuntimeException $e) {
			if ($e->getCode() == Router::NO_ROUTE)
			{
				$this->httpResponse->redirect404();
			}
		}

		$_GET = array_merge($_GET, $matchedRoute->getVars());

		$controllerClass = 'App\\Modules\\'.$matchedRoute->getModule().'\\'.$matchedRoute->getModule().'Controller';
		return new $controllerClass($this, $matchedRoute->getModule(), $matchedRoute->getAction());
	}

	public function run()
	{
		$controller = $this->getController();
		$controller->execute();

		$this->httpResponse->setPage($controller->getPage());
		$this->httpResponse->send();
	}

	// GETTERS & SETTERS

	public function getHttpRequest()
	{
		return $this->httpRequest;
	}

	public function getHttpResponse()
	{
		return $this->httpResponse;
	}
}
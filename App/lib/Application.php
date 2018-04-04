<?php

namespace App;

use Entity\User;
use App\Session;

class Application
{
    protected $httpRequest;
    protected $httpResponse;
    protected $config;

    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
        $this->httpResponse = new HttpResponse();
        $this->config = new Config();
    }

    /**
     * Get the controller to call
     * @return Controller $controllerClass
     */
    public function getController()
    {
        $router = new Router();

        $xml = new \DOMDocument();
        $xml->load(__DIR__ . '/../Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        foreach ($routes as $route) {
            $vars = [];
            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $route->getAttribute('layout'), $vars));
        }

        try {
            $matchedRoute = $router->getRoute($this->httpRequest->getRequestURI());
        } catch (\RuntimeException $e) {
            if ($e->getCode() == Router::NO_ROUTE) {
                $this->httpResponse->redirect404();
            }
        }

        $_GET = array_merge($_GET, $matchedRoute->getVars());

        $controllerClass = 'Controller\\'.$matchedRoute->getModule().'Controller';
        return new $controllerClass($this, $matchedRoute->getModule(), $matchedRoute->getAction(), $matchedRoute->getLayout());
    }

    /**
     * Run the application
     */
    public function run()
    {
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }

    /**
     * Get http request
     * @return  HttpRequest $httpRequest [The request]
     */
    public function getHttpRequest()
    {
        return $this->httpRequest;
    }

    /**
     * Get http response
     * @return HttpResponse $httpResponse [The response]
     */
    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    /**
     * Get config
     * @return Config $config [The config]
     */
    public function getConfig()
    {
        return $this->config;
    }
}
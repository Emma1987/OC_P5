<?php

namespace App;

class Router
{
    protected $routes = [];

    const NO_ROUTE = 1;

    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes)) {
            $this->routes[] = $route;
        }
    }

    public function match(Route $route, $url)
    {
        if (preg_match('#^'.$route->getUrl().'$#', $url, $matches)) {
            return $matches;
        } else {
            return false;
        }
    }

    public function getRoute($url)
    {
        foreach ($this->routes as $route) {
            if (($varsValues = $this->match($route, $url)) !== false) {
                if ($route->hasVars()) {
                    $varsNames = $route->getVarsNames();
                    $listVars = [];

                    foreach ($varsValues as $key => $match) {
                        if ($key !== 0) {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }
                    $route->setVars($listVars);
                }
                return $route;
            }
        }
        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    }
}
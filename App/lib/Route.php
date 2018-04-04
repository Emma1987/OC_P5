<?php

namespace App;

class Route
{
    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $module;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $layout;

    /**
     * @var array
     */
    protected $varsNames;

    /**
     * @var array
     */
    protected $vars = [];

    public function __construct($url, $module, $action, $layout, array $varsNames)
    {
        $this->setAction($action);
        $this->setModule($module);
        $this->setUrl($url);
        $this->setLayout($layout);
        $this->setVarsNames($varsNames);
    }

    /**
     * Defines if a route has variables
     */
    public function hasVars()
    {
        return !empty($this->getVarsNames());
    }

    /**
     * Get action
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get module
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Get url
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get layout
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Get vars names
     * @return array
     */
    public function getVarsNames()
    {
        return $this->varsNames;
    }

    /**
     * Get vars
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * Set action
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * Set module
     * @param string $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * Set url
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Set layout
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Set vars names
     * @param array $varsNames
     */
    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }

    /**
     * Set vars
     * @param array $vars
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }
}
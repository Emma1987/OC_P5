<?php

namespace App;

use App\Application;

class Page extends Application
{
    /**
     * @var string
     */
    protected $contentFile;

    /**
     * @var array
     */
    protected $vars = [];

    /**
     * @var string
     */
    protected $layout;

    /**
     * Set values to the route variables
     * @param string $var
     * @param string $value
     */
    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle.');
        }

        $this->vars[$var] = $value;
    }

    /**
     * Get the page to return
     */
    public function getPage()
    {
        if (!file_exists($this->contentFile)) {
            throw new \RuntimeException('La vue spécifiée n\'existe pas.');
        }

        $session = Session::getInstance();

        extract($this->vars);

        ob_start();
            include $this->contentFile;
        $content = ob_get_clean();

        ob_start();
            include $this->layout;
        return ob_get_clean();
    }

    /**
     * Get content file
     * @return string
     */
    public function getContentFile()
    {
        return $this->contentFile;
    }

    /**
     * Set content file
     * @param string $contentFile
     */
    public function setContentFile($contentFile)
    {
        $this->contentFile = $contentFile;
    }

    /**
     * Set layout
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
<?php
namespace EmmaM;

use EmmaM\Application;

class Page extends Application
{
    protected $contentFile;
    protected $vars = [];
    protected $layout;

    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle.');
        }

        $this->vars[$var] = $value;
    }

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

    // GETTERS & SETTERS

    public function getContentFile()
    {
        return $this->contentFile;
    }

    public function setContentFile($contentFile)
    {
        $this->contentFile = $contentFile;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
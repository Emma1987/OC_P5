<?php

namespace App;

class HttpResponse
{
    protected $page;

    public function addHeader($header)
    {
        header($header);
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
        exit;
    }

    public function redirect404()
    {
        $this->page = new Page();

        $this->page->setContentFile(__DIR__ . '/../../Web/Errors/404.php');
        $this->page->setLayout(__DIR__ . '/../../Web/Errors/errorLayout.php');

        $this->addHeader('HTTP/1.0 404 NOT FOUND');

        $this->send();
    }

    public function send()
    {
        exit($this->page->getPage());
    }

    // GETTERS & SETTERS

    public function setPage(Page $page)
    {
        $this->page = $page;
    }
}
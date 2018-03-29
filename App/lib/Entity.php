<?php

namespace App;

use App\Session;

abstract class Entity
{
    protected $errors = [];

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    private function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    public function getErrorMessage()
    {
        $errors = $this->getErrors();
        $message = '';
        foreach ($errors as $error) {
            $message .= ($error . '<br />');
        }
        Session::getInstance()->setFlash('danger', $message);
    }

    // GETTERS & SETTERS
    
    public function getErrors()
    {
        return $this->errors;
    }
}
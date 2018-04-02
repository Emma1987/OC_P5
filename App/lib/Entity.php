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

    /**
     * Hydrate a new entity
     * @param  array  $data
     */
    private function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    /**
     * Construct the error message to display
     * @return string
     */
    public function getErrorMessage()
    {
        $errors = $this->getErrors();
        $message = '';
        foreach ($errors as $error) {
            $message .= ($error . '<br />');
        }
        Session::getInstance()->setFlash('danger', $message);
    }

    /**
     * Get errors
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
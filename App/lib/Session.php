<?php

namespace App;

class Session
{
    /**
     * @var Session
     */
    static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    public function __construct()
    {
        session_start();
    }

    /**
     * Define if a session is active
     * @return boolean
     */
    public function isActive()
    {
        return !empty($this->getAttribute('auth'));
    }

    /**
     * Set flash message
     * @param string $key
     * @param string $value
     */
    public function setFlash($key, $value)
    {
        $_SESSION['flash'][$key] = $value;
    }

    /**
     * Define if session as flash message
     * @return boolean
     */
    public function hasFlashes()
    {
        return !empty($_SESSION['flash']);
    }

    /**
     * Get flash message
     */
    public function getFlash()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    /**
     * Get attribute
     * @param  string $key
     */
    public function getAttribute($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Set attribute
     * @param string $key
     * @param string $value
     */
    public function setAttribute($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
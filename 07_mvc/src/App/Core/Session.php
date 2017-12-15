<?php

namespace App\Core;

use App\Core\Traits\Singleton;

class Session
{
    use Singleton;

    protected function __construct()
    {
        session_start();
    }
    public function destroy()
    {
        session_destroy();
        self::$instance = new static();
    }

    /**
     * @param $message
     * @return void
     */
    public static function setFlash($message)
    {
        if (!isset($_SESSION['flash']) || !is_array($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }
        $_SESSION['flash'][] = $message;
    }

    /**
     * @return bool
     */
    public static function hasFlash()
    {
        return !empty($_SESSION['flash']);
    }

    /**
     * @return array
     */
    public static function getFlash()
    {
        $data = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];
        $_SESSION['flash'] = [];
        return $data;
    }

    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public function __destruct()
    {
        session_write_close();
    }
}
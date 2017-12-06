<?php

namespace App\DB;

abstract class Singleton
{
    protected static $uniqueInstance = null;

    protected function __construct()
    {
    }

    final private function __clone()
    {
    }

    public static function getInstance()
    {
        if (static::$uniqueInstance === null) {
            static::$uniqueInstance = new static();
        }

        return static::$uniqueInstance;
    }
}
<?php

namespace App\Main;

class Config implements IConfig
{
    private static $configuration = [
        'dbHost' => 'localhost',
        'dbUser' => 'goods',
        'dbPassword' => 'goods',
        'dbName' => 'goods',

        'tablesMap' => [
            'category' => 'category',
            'product' => 'product',
        ],

        'count' => 5
    ];

    public static function get($paramName)
    {
       return self::$configuration[$paramName];
    }
}
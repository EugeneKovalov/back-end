<?php

namespace App\DB;

use App\Main\Config;

class Connection extends Singleton implements IConnection
{
    private static $connection;

    protected function __construct()
    {
        $host = Config::get('dbHost');
        $name = Config::get('dbName');
        $user = Config::get('dbUser');
        $password = Config::get('dbPassword');

        static::$connection = mysqli_connect($host, $user, $password, $name);
    }

    public function query($query)
    {
        return mysqli_query(static::$connection, $query);
    }

    public function get()
    {
        return static::$connection;
    }
}


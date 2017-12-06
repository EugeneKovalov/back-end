<?php
    namespace App\Main;

    interface IConfig
    {
        public static function get($paramName);
    }
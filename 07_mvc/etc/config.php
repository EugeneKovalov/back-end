<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/1/17
 * Time: 21:14
 */

use App\Core\Config;

/**
 * Routing
 */
Config::set('routes', ['default', 'admin']);
Config::set('defaultRoute', 'default');
Config::set('defaultController', 'Pages');
Config::set('defaultAction', 'index');

/**
 * Lang
 */
Config::set('languages', ['en', 'ru']);
Config::set('defaultLanguage', 'ru');

/**
 * Debug
 */
Config::set('debug', true);


/**
 * Meta
 */
Config::set('siteName', 'Academy MVC');

/**
 * Database
 */
Config::set('db.host', 'localhost:8889');
Config::set('db.user', 'root');
Config::set('db.password', 'root');
Config::set('db.name', 'mvc');

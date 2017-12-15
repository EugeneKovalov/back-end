<?php

use App\Core\Config;

class RouterTest extends \PHPUnit\Framework\TestCase
{
    public function testInitialization()
    {
        $router = new \App\Core\Router('/users/register');

        $this->assertEquals(Config::get('defaultRoute'), $router->getRoute());
        $this->assertEquals(Config::get('defaultLanguage'), $router->getLang());
        $this->assertEquals('UsersController', $router->getController());
        $this->assertEquals('registerAction', $router->getAction());
        $this->assertEquals(['1'], $router->getParams());
    }
}
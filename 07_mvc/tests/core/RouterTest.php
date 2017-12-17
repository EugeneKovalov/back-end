<?php

class RouterTest extends \PHPUnit\Framework\TestCase
{
    public function testPagesIndex()
    {
        $router = new \App\Core\Router('/Pages/index');

        $this->assertEquals('default', $router->getRoute());
        $this->assertEquals('ru', $router->getLang());
        $this->assertEquals('Pages', $router->getController());
        $this->assertEquals('index', $router->getAction());
    }

    public function testPagesEnIndex()
    {
        $router = new \App\Core\Router('/en/Pages/index');

        $this->assertEquals('default', $router->getRoute());
        $this->assertEquals('en', $router->getLang());
        $this->assertEquals('Pages', $router->getController());
        $this->assertEquals('index', $router->getAction());
    }

    public function testPagesEnPagesView1()
    {
        $router = new \App\Core\Router('/en/Pages/view/1');

        $this->assertEquals('default', $router->getRoute());
        $this->assertEquals('en', $router->getLang());
        $this->assertEquals('Pages', $router->getController());
        $this->assertEquals('view', $router->getAction());
        $this->assertEquals(['1'], $router->getParams());
    }

    public function testPagesUsersRegister()
    {
        $router = new \App\Core\Router('/users/register/index');

        $this->assertEquals('default', $router->getRoute());
        $this->assertEquals('en', $router->getLang());
        $this->assertEquals('Users', $router->getController());
        $this->assertEquals('register', $router->getAction());
        $this->assertEquals(['index'], $router->getParams());
    }
}
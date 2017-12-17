<?php

class BuildUriTest extends \PHPUnit\Framework\TestCase
{
    public function testPagesIndex()
    {
        $router = new \App\Core\Router('/pages');

        $this->assertEquals('/Pages/index', $router->buildUri('index'));
        $this->assertEquals('/Pages/index/11', $router->buildUri('index', ['11']));
        $this->assertEquals('/pages/test',  $router->buildUri('pages.test'));
        $this->assertEquals('/',  $router->buildUri('.'));
    }

    public function testPagesEnIndex()
    {
        $router = new \App\Core\Router('/en/Pages/');

        $this->assertEquals('/en/pages/index', $router->buildUri('index'));
        $this->assertEquals('/en/pages/test',  $router->buildUri('test'));
    }

    public function testPagesEnPagesView1()
    {
        $router = new \App\Core\Router('/en/Pages/');

        $this->assertEquals('/en/pages/view/1', $router->buildUri('view', ['1']));
        $this->assertEquals('/en/pages/view/2',  $router->buildUri('view', ['2']));
    }

    public function testPagesUsersRegister()
    {
        $router = new \App\Core\Router('/users');

        $this->assertEquals('/users/register', $router->buildUri('register'));
        $this->assertEquals('/users/register/index', $router->buildUri('register.index'));
        $this->assertEquals('/users/register/index/2', $router->buildUri('register.index', ['2']));
    }
}
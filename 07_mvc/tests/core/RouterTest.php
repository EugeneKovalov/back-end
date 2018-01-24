<?php

class RouterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testPagesIndex($expected, $a)
    {
        $router = new \App\Core\Router('/Pages/index');

        $this->assertEquals('default', $router->getRoute());
        $this->assertEquals('ru', $router->getLang());
        $this->assertEquals('Pages', $router->getController());
        $this->assertEquals('index', $router->getAction());
    }

    public function additionProvider()
    {
        return [
            [0, 0, 0],
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 3]
        ];
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

    public function testBuildUriPagesIndex()
    {
        $router = new \App\Core\Router('/pages');

        $this->assertEquals('/Pages/index', $router->buildUri('index'));
        $this->assertEquals('/Pages/index/11', $router->buildUri('index', ['11']));
        $this->assertEquals('/pages/test',  $router->buildUri('pages.test'));
        $this->assertEquals('/',  $router->buildUri('.'));
    }

    public function testBuildUriPagesEnIndex()
    {
        $router = new \App\Core\Router('/en/Pages/');

        $this->assertEquals('/en/pages/index', $router->buildUri('index'));
        $this->assertEquals('/en/pages/test',  $router->buildUri('test'));
    }

    public function testBuildUriPagesEnPagesView1()
    {
        $router = new \App\Core\Router('/en/Pages/');

        $this->assertEquals('/en/pages/view/1', $router->buildUri('view', ['1']));
        $this->assertEquals('/en/pages/view/2',  $router->buildUri('view', ['2']));
    }

    public function testBuildUriPagesUsersRegister()
    {
        $router = new \App\Core\Router('/users');

        $this->assertEquals('/users/register', $router->buildUri('register'));
        $this->assertEquals('/users/register/index', $router->buildUri('register.index'));
        $this->assertEquals('/users/register/index/2', $router->buildUri('register.index', ['2']));
    }
}
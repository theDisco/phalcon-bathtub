<?php

namespace Bathtub\Phalcon;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Router
     */
    private $router;

    protected function setUp()
    {
        $this->router = new Router();
    }

    public function testAddRoutes()
    {
        $this->router->add('/', [
            'module' => 'test_module',
            'controller' => 'test_controller',
            'action' => 'test_action',
        ]);
        $this->router->handle('/');
        $this->assertEquals('/', $this->router->getMatchedRoute()->getPattern());
        $this->assertEquals('test_module', $this->router->getModuleName());
        $this->assertEquals('test_controller', $this->router->getControllerName());
        $this->assertEquals('test_action', $this->router->getActionName());
    }
}

<?php

namespace Bathtub\Routing;

use Mockery;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    private static $testRoutes = [
        'get' => [
            'method' => 'get',
        ],
        'post' => [
            'method' => 'post',
        ],
        'put' => [
            'method' => 'put',
        ],
        'delete' => [
            'method' => 'delete',
        ],
        'options' => [
            'method' => 'options',
        ]
    ];

    public function testRegisterRoutes()
    {
        $router = new Router(self::getRouteAwereMock());
        $actualRouterAware = $router->registerRoutes(self::$testRoutes);
        $this->assertInstanceOf('\Bathtub\Routing\RouteAware', $actualRouterAware);
    }

    public function testFailOnConfigurationError()
    {
        $this->setExpectedException('\Bathtub\Routing\RouterException', 'Unsupported http method: not_supported');
        $router = new Router(self::getRouteAwereMock(false));
        $router->registerRoutes([
            'not_supported' => [
                'method' => 'not_supported'
            ]
        ]);
    }

    private static function getRouteAwereMock($includeStubs = true)
    {
        $routeAware = Mockery::mock('Bathtub\Phalcon\Router');
        if ($includeStubs) {
            $routeAware->shouldReceive('addGet')->once()->with('get', self::$testRoutes['get']);
            $routeAware->shouldReceive('addPost')->once()->with('post', self::$testRoutes['post']);
            $routeAware->shouldReceive('addPut')->once()->with('put', self::$testRoutes['put']);
            $routeAware->shouldReceive('addDelete')->once()->with('delete', self::$testRoutes['delete']);
            $routeAware->shouldReceive('addOptions')->once()->with('options', self::$testRoutes['options']);
        }
        return $routeAware;
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}

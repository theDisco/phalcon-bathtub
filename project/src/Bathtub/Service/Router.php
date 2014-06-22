<?php

namespace Bathtub\Service;

use Bathtub\Routing\RouteAware;

class Router
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @param RouteAware $router
     * @param array $routes
     */
    public function __construct(RouteAware $router, array $routes)
    {
        $this->router = $router;
        $this->routes = $routes;
    }

    /**
     * @param ServiceAware $container
     */
    public function registerTo(ServiceAware $container)
    {
        $container->setShared('router', function() {
            return (new \Bathtub\Routing\Router($this->router))
                ->registerRoutes($this->routes);
        });
    }
}

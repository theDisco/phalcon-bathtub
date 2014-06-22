<?php

namespace Bathtub\Routing;

class Router
{
    /**
     * @var RouteAware
     */
    private $router;

    /**
     * @param RouteAware $router
     */
    public function __construct(RouteAware $router)
    {
        $this->router = $router;
    }

    /**
     * @param array $routes
     * @return RouteAware
     * @throws RouterException
     */
    public function registerRoutes(array $routes)
    {
        foreach ($routes as $route => $config) {
            switch ($config['method']) {
                case 'get':
                    $this->router->addGet($route, $config);
                    break;
                case 'post':
                    $this->router->addPost($route, $config);
                    break;
                case 'put':
                    $this->router->addPut($route, $config);
                    break;
                case 'delete':
                    $this->router->addDelete($route, $config);
                    break;
                case 'options':
                    $this->router->addOptions($route, $config);
                    break;
                default:
                    throw new RouterException(
                        sprintf('Unsupported http method: %s', $config['method'])
                    );
            }
        }
        return $this->router;
    }
}

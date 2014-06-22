<?php

namespace Bathtub\Phalcon;

use Bathtub\RouteAware;

class Router extends \Phalcon\Mvc\Router implements RouteAware
{}

/*
function () {
    $router = new Router();
    $router->setDefaultModule("frontend");

    $router->add("/login", array(
        'module'     => 'backend',
        'controller' => 'login',
        'action'     => 'index',
    ));

    $router->add("/admin/products/:action", array(
        'module'     => 'backend',
        'controller' => 'products',
        'action'     => 1,
    ));

    $router->add("/products/:action", array(
        'controller' => 'products',
        'action'     => 1,
    ));

    return $router;
}*/
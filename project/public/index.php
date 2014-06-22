<?php

require_once __DIR__ . '/../vendor/autoload.php';

$env = getenv('APPLICATION_ENV') ?: 'development';
$config = new \Phalcon\Config(include __DIR__ . '/../config/' . $env . '.php');

use Phalcon\Mvc\Application;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;

$di = new FactoryDefault();
$di->setShared('router', function() use($config) {
    return (new \Bathtub\Router(new \Bathtub\Phalcon\Router()))
        ->registerRoutes($config->get('routes')->toArray());
});

try {
    $application = new Application($di);
    $application->registerModules($config->get('modules')->toArray());
    echo $application->handle()->getContent();
} catch(\Exception $e) {
    // TODO: handle errors gracefully
    echo $e->getMessage();
    echo sprintf('<pre>%s</pre>', $e->getTraceAsString());
}
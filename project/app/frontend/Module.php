<?php

namespace Frontend;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerAutoloaders($dependencyInjector)
    {
        $loader = new Loader();
        $loader->registerNamespaces([
            'Frontend\Controllers' => __DIR__ . '/controllers/',
            'Frontend\Models' => __DIR__ . '/models/',
        ]);
        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerServices($dependencyInjector)
    {
        $dependencyInjector->set('dispatcher', function() use($dependencyInjector) {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Frontend\Controllers');
            return $dispatcher;
        });

        $dependencyInjector->set('view', function() {
            $view = new View();
            $view->setViewsDir(__DIR__  . '/views');
            return $view;
        });
    }
}

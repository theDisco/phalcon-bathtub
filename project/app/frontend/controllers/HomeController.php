<?php

namespace Frontend\Controllers;

class HomeController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $this->view->setVar('hello', 'Hello');
    }
} 
<?php

$env = getenv('APPLICATION_ENV') ?: 'development';
$config = new \Phalcon\Config(include __DIR__ . '/../config/' . $env . '.php');
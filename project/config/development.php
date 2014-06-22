<?php return [
    'modules' => [
        'frontend' => [
            'className' => 'Frontend\Module',
            'path'      => __DIR__ . '/../app/frontend/Module.php',
        ],
    ],
    'routes' => [
        '/' => [
            'module' => 'frontend',
            'controller' => 'home',
            'action' => 'index',
            'method' => 'get',
        ],
    ],
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'my_project',
    ],
];
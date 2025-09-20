<?php

return [
    'db' => [
        'driver' => 'Pdo_Mysql',
        'database' => 'escada',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '20202020Vi',
        'charset'  => 'utf8',
    ],
    'service_manager' => [
        'factories' => [
            'Laminas\Db\Adapter\Adapter' => function ($container) {
                $config = $container->get('config');
                return new Laminas\Db\Adapter\Adapter($config['db']);
            },
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'route' => 'home',
                'icon'  => 'fa-solid fa-house',
            ],
            [
                'label' => 'Clientes',
                'route' => 'clientes',
                'icon' => 'fa-solid fa-person'
            ]
        ],
    ],
];

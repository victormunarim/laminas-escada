<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

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
];

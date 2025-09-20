<?php

declare(strict_types=1);

namespace Clientes;

use Application\View\Helper\BarraPesquisaHelperGenerica;
use Clientes\Controller\ClientesController;
use Clientes\Factory\Controller\ClientesControllerFactory;
use Clientes\Model\ClientesTable;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Clientes\Form\PesquisaForm;
use Psr\Container\ContainerInterface;

return [
    'controllers' => [
        'factories' => [
            ClientesController::class => ClientesControllerFactory::class,
        ],
    ],

    'view_helpers' => [
        'factories' => [
            /**
             * @param ContainerInterface $container
             */
            TabelaClientesHelper::class => function ($container) {
                return new TabelaClientesHelper(
                    $container->get(ClientesTable::class)
                );
            },
            BarraPesquisaHelperGenerica::class => InvokableFactory::class,
        ],

        'aliases' => [
            'tabelaClientes' => TabelaClientesHelper::class,
            'barraPesquisa'   => BarraPesquisaHelperGenerica::class,
        ]
    ],

    'router' => [
        'routes' => [
            'clientes' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/' . 'clientes' . '[/:action[/:id_cliente]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_pedido' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => ClientesController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'factories' => [
            PesquisaForm::class => function ($container): PesquisaForm {
                return new PesquisaForm();
            },
        ]
    ]
];

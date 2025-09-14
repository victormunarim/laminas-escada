<?php

declare(strict_types=1);

namespace Pedidos;

use Pedidos\Controller\PedidosController;
use Pedidos\Factory\Controller\PedidosControllerFactory;
use Pedidos\Form\PedidoForm;
use Pedidos\Model\PedidosTable;
use Pedidos\Model\PedidosTableFactory;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\AdapterServiceFactory;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Psr\Container\ContainerInterface;

return [
    'controllers' => [
        'factories' => [
            PedidosController::class => PedidosControllerFactory::class,
        ],
    ],

    'view_helpers' => [
        'factories' => [
            /**
             * @param ContainerInterface $container
             * @return TabelaPedidosHelper
             */
            TabelaPedidosHelper::class => function ($container): TabelaPedidosHelper {
                return new TabelaPedidosHelper();
            },
            BarraPesquisaHelper::class => InvokableFactory::class,
            MensagensAlertHelper::class => InvokableFactory::class,
        ],
        'aliases' => [
            'tabelaPedidos'   => TabelaPedidosHelper::class,
            'barraPesquisa'   => BarraPesquisaHelper::class,
            'mensagensAlert'  => MensagensAlertHelper::class,
        ],
    ],

    'router' => [
        'routes' => [
            'Pedidos' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/Pedidos[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\PedidosController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'Pedidos' => __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'factories' => [
            PedidosTable::class => PedidosTableFactory::class,
            Adapter::class      => AdapterServiceFactory::class,

            /**
             * @param ContainerInterface $container
             * @return PedidoForm
             */
            PedidoForm::class => function ($container): PedidoForm {
                return new PedidoForm();
            },
        ],
    ],
];

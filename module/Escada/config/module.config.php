<?php

declare(strict_types=1);

namespace Escada;

use Escada\Controller\PedidosController;
use Escada\Factory\Controller\PedidosControllerFactory;
use Escada\Form\PedidoForm;
use Escada\Model\PedidosTable;
use Escada\Model\PedidosTableFactory;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\AdapterServiceFactory;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            PedidosController::class => PedidosControllerFactory::class,
        ],
    ],

    'view_helpers' => [
        'factories' => [
            TabelaPedidosHelper::class => function ($container) {
                return new TabelaPedidosHelper();
            },
            BarraPesquisaHelper::class => InvokableFactory::class,
            MensagensAlertHelper::class => InvokableFactory::class,
        ],
        'aliases' => [
            'tabelaPedidos' => TabelaPedidosHelper::class,
            'barraPesquisa' => BarraPesquisaHelper::class,
            'mensagensAlert' => MensagensAlertHelper::class,
        ],
    ],

    'router' => [
        'routes' => [
            'escada' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/escada[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PedidosController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'escada' => __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'factories' => [
            PedidosTable::class => PedidosTableFactory::class,
            Adapter::class => AdapterServiceFactory::class,
            PedidoForm::class => function ($container) {
                $form = new PedidoForm();
                return $form;
            }
        ]
    ],
];

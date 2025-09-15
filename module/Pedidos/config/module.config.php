<?php

declare(strict_types=1);

namespace Pedidos;

use Pedidos\Constantes\ConstantesPedidos;
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
            FormEditPedidosHelper::class => InvokableFactory::class,
            FormAddPedidosHelper::class => InvokableFactory::class,
            FormDeletePedidosHelper::class => InvokableFactory::class,
        ],
        'aliases' => [
            'tabelaPedidos'   => TabelaPedidosHelper::class,
            'barraPesquisa'   => BarraPesquisaHelper::class,
            'mensagensAlert'  => MensagensAlertHelper::class,
            'formEditPedidos'  => FormEditPedidosHelper::class,
            'formAddPedidos'  => FormAddPedidosHelper::class,
            'formDeletePedidos'  => FormDeletePedidosHelper::class,
        ],
    ],

    'router' => [
        'routes' => [
            ConstantesPedidos::ROUTE => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/' . ConstantesPedidos::ROUTE . '[/:action[/:id]]',
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
            ConstantesPedidos::ROUTE => __DIR__ . '/../view',
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

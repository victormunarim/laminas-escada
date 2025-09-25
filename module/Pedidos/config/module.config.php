<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\BarraPesquisaHelperGenerica;
use Application\View\Helper\FormAddHelperGenerico;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\AdapterServiceFactory;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Pedidos\Constantes\ConstantesPedidos;
use Pedidos\Controller\PedidosController;
use Pedidos\Factory\Controller\PedidosControllerFactory;
use Pedidos\Form\PedidoForm;
use Pedidos\Form\PesquisaForm;
use Pedidos\GeraPdf\GeraPdf;
use Pedidos\Model\Pedidos;
use Pedidos\Model\PedidosTable;
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
            TabelaPedidosHelper::class => function ($container) {
                return new TabelaPedidosHelper(
                    $container->get(PedidosTable::class)
                );
            },
            BarraPesquisaHelperGenerica::class => InvokableFactory::class,
            MensagensAlertHelper::class => InvokableFactory::class,
            FormEditPedidosHelper::class => InvokableFactory::class,
            FormAddHelperGenerico::class => InvokableFactory::class,
            FormDeletePedidosHelper::class => InvokableFactory::class,
            GeraPdf::class => InvokableFactory::class,
        ],
        'aliases' => [
            'tabelaPedidos'   => TabelaPedidosHelper::class,
            'barraPesquisa'   => BarraPesquisaHelperGenerica::class,
            'mensagensAlert'  => MensagensAlertHelper::class,
            'formEditPedidos'  => FormEditPedidosHelper::class,
            'formAddPedidos'  => FormAddHelperGenerico::class,
            'formDeletePedidos'  => FormDeletePedidosHelper::class,
            'geraPdf'  => GeraPdf::class,
        ],
    ],

    'router' => [
        'routes' => [
            ConstantesPedidos::ROUTE => [
                'type' => Segment::class,
                'options' => [
                    'route'       => '/' . ConstantesPedidos::ROUTE . '[/:action[/:id_pedido]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_pedido' => '[0-9]+',
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
            PedidosTable::class => function ($container) {
                $tableGateway = $container->get('PedidosTableGateway');
                return new PedidosTable($tableGateway);
            },
            Adapter::class => AdapterServiceFactory::class,

            'PedidosTableGateway' => function ($container) {
                $dbAdapter = $container->get('Laminas\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Pedidos());
                return new TableGateway('pedidos', $dbAdapter, null, $resultSetPrototype);
            },

            /**
             * @param ContainerInterface $container
             * @return PedidoForm
             */
            PedidoForm::class => function ($container): PedidoForm {
                return new PedidoForm();
            },
            PesquisaForm::class => function ($container): PesquisaForm {
                return new PesquisaForm();
            },
        ],
    ],
];

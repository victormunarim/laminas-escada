<?php

declare(strict_types=1);

namespace Pedidos\Factory\Controller;

use Pedidos\Controller\PedidosController;
use Pedidos\Form\PedidoForm;
use Pedidos\Model\PedidosTable;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class PedidosControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array<string,mixed>|null $options
     * @return PedidosController
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): PedidosController
    {
        $table = $container->get(PedidosTable::class);
        $form = $container->get(PedidoForm::class);

        return new PedidosController($table, $form);
    }
}

<?php

declare(strict_types=1);

namespace Escada\Factory\Controller;

use Escada\Controller\PedidosController;
use Escada\Form\PedidoForm;
use Escada\Model\PedidosTable;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class PedidosControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $table = $container->get(PedidosTable::class);
        $form = $container->get(PedidoForm::class);
        return new PedidosController($table, $form);
    }
}

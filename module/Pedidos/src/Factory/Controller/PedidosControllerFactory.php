<?php

declare(strict_types=1);

namespace Pedidos\Factory\Controller;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Pedidos\Controller\PedidosController;
use Pedidos\Form\PedidoForm;
use Pedidos\Form\PesquisaForm;
use Pedidos\Model\PedidosTable;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class PedidosControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array<string,mixed>|null $options
     * @return PedidosController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): PedidosController
    {
        $table = $container->get(PedidosTable::class);
        $form = $container->get(PedidoForm::class);
        $pesquisaForm = $container->get(PesquisaForm::class);

        return new PedidosController($table, $form, $pesquisaForm);
    }
}

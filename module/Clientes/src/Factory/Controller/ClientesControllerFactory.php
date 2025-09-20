<?php

declare(strict_types=1);

namespace Clientes\Factory\Controller;

use Clientes\Controller\ClientesController;
use Clientes\Form\PesquisaForm;
use Clientes\Model\ClientesTable;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class ClientesControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ClientesController
    {
        $clienteTable = $container->get(ClientesTable::class);
        $pesquisaForm = $container->get(PesquisaForm::class);
        return new ClientesController($clienteTable, $pesquisaForm);
    }
}
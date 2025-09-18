<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class ClientesTableFactory
{
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        ?array $options = null
    ): ClientesTable {
        $dbAdapter = $container->get(AdapterInterface::class);

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Clientes());

        $tableGateway = new TableGateway('clientes', $dbAdapter, null, $resultSetPrototype);

        return new ClientesTable($tableGateway);
    }
}
<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class PedidosTableFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array<string, mixed>|null $options
     * @return PedidosTable
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, string $requestedName, ?array $options = null): PedidosTable
    {
        $dbAdapter = $container->get(AdapterInterface::class);

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Pedidos());

        $tableGateway = new TableGateway('pedidos', $dbAdapter, null, $resultSetPrototype);

        return new PedidosTable($tableGateway);
    }
}

<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Psr\Container\ContainerInterface;

class PedidosTableFactory
{
    /**
     * @param array<string, mixed>|null $options
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

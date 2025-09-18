<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;

class ClientesTable
{
    private TableGatewayInterface $tableGateway;

    /**
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getClientes(int $id): Clientes
    {
        $rowset = $this->tableGateway->select(['cliente_id' => $id]);
        $row = $rowset->current();

        return $row;
    }
}
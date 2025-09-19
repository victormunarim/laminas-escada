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

    public function pegaClienteIdPeloNome(string $nome): int
    {
        $sql = $this->tableGateway->getSql();
        $select = $sql->select();
        $select->where->like('nome', $nome);

        $resultSet = $this->tableGateway->selectWith($select);
        $row = $resultSet->current();

        return $row ? (int) $row->getId() : 0;
    }

    public function pegaTodosClientes()
    {
        $select = $this->tableGateway->getSql()->select();

        return $this->tableGateway->selectWith($select);
    }
}
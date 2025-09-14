<?php

namespace Escada\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class PedidosTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getPedidos($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function savePedido(Pedidos $pedido)
    {
        $data = [
            'nome' => $pedido->getNome(),
        ];

        $id = (int) $pedido->getId();

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getPedidos($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update pedido with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deletePedido($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}

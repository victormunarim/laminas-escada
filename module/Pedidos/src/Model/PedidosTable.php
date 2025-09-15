<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Pedidos\Constantes\ConstantesPedidos;
use RuntimeException;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\TableGatewayInterface;

class PedidosTable
{
    private TableGatewayInterface $tableGateway;

    /**
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return ResultSetInterface
     */
    public function fetchAll(): ResultSetInterface
    {
        return $this->tableGateway->select();
    }

    /**
     * @param int $id
     * @return Pedidos
     * @throws RuntimeException
     */
    public function getPedidos(int $id): Pedidos
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();

        if (! $row instanceof Pedidos) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    /**
     * @param Pedidos $pedido
     * @throws RuntimeException
     */
    public function savePedido(Pedidos $pedido): void
    {
        $data = [
            ConstantesPedidos::NOME_NAME  => $pedido->getNome(),
            ConstantesPedidos::IDADE_NAME => $pedido->getIdade(),
            ConstantesPedidos::DATA_NAME => $pedido->getData(),
        ];

        $id = (int) $pedido->getId();

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        $this->getPedidos($id);

        $this->tableGateway->update($data, ['id' => $id]);
    }

    /**
     * @param int $id
     */
    public function deletePedido(int $id): void
    {
        $this->tableGateway->delete(['id' => $id]);
    }

    /**
     * @param array<string, mixed> $filtros
     * @return ResultSetInterface
     */
    public function procuraPedidos(array $filtros): ResultSetInterface
    {
        /** @var Select $select */
        $select = $this->tableGateway->getSql()->select();
        $where = $select->where;

        foreach ($filtros as $campo => $valor) {
            if (! empty($valor)) {
                if ($campo === 'idade') {
                    $where->equalTo($campo, $valor);
                } elseif ($campo === 'data') {
                    $where->equalTo($campo, $valor);
                } else {
                    $where->like($campo, '%' . $valor . '%');
                }
            }
        }

        return $this->tableGateway->selectWith($select);
    }
}

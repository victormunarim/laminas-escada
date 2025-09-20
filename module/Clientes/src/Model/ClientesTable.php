<?php

declare(strict_types=1);

namespace Clientes\Model;

use Clientes\Constantes\ConstantesClientes;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
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

    public function pegaTodosClientes(): ResultSet
    {
        $select = $this->tableGateway->getSql()->select();

        return $this->tableGateway->selectWith($select);
    }

    public function procuraClientesEEnderecos(array $filtros): ResultSet
    {
        /** @var Select $select */
        $select = $this->tableGateway->getSql()->select()->join(
            'endereco_cliente',
            'endereco_cliente.cliente_id = clientes.cliente_id',
            ['*']
        );

        $where = $select->where;
        $where->equalTo('clientes.' . ConstantesClientes::FLAG_OCULTO_NAME, 0);
        foreach ($filtros as $campo => $valor) {
            if ($valor !== null && $valor !== '') {
                if (
                    $campo === 'cep'
                    || $campo === 'numero'
                ) {
                    $where->equalTo($campo, (int)$valor);
                } else {
                    $where->like($campo, '%' . $valor . '%');
                }
            }
        }

        return $this->tableGateway->selectWith($select);
    }
}

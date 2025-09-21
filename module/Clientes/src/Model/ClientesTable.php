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

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getClientes(int $id): Clientes
    {
        $rowset = $this->tableGateway->select(['cliente_id' => $id]);
        return empty($rowset->current()) ? new Clientes() : $rowset->current();
    }

    public function getEnderecoPeloIdpedido(int $idPedido)
    {
        /** @var Select $select */
        $select = $this->tableGateway->getSql()->select();

        $select->join(
            'pedidos',
            'pedidos.cliente_id = clientes.cliente_id',
            ['id_pedido']
        );

        $where = $select->where;
        $where->equalTo('clientes.' . ConstantesClientes::FLAG_OCULTO_NAME, 0);
        $where->equalTo('pedidos.id_pedido', $idPedido);

        $dados = $this->tableGateway->selectWith($select);
        if ($dados instanceof ResultSet) {
            $dados = iterator_to_array($dados);
        }

        return $dados;
    }

    public function saveCliente(Clientes $cliente): void
    {
        $data = [
            ConstantesClientes::CLIENTE_NOME_NAME => $cliente->getNome() ?? '',
            ConstantesClientes::EMAIL_NAME => $cliente->getEmail() ?? '',
            ConstantesClientes::NUMERO_NAME => $cliente->getNumero() ?? 0,
            ConstantesClientes::BAIRRO_NAME => $cliente->getBairro() ?? '',
            ConstantesClientes::CIDADE_NAME => $cliente->getCidade() ?? '',
            ConstantesClientes::CEP_NAME => $cliente->getCep() ?? 0,
            ConstantesClientes::REFERENCIA_NAME => $cliente->getReferencia() ?? '',
            ConstantesClientes::CPF_NAME => $cliente->getCpf() ?? '',
            ConstantesClientes::RG_NAME => $cliente->getRg() ?? '',
            ConstantesClientes::CNPJ_NAME => $cliente->getCnpj() ?? '',
            ConstantesClientes::SS_NAME => $cliente->getSS() ?? '',
            ConstantesClientes::FLAG_OCULTO_NAME => $cliente->getFlagOculto() ?? 0,
        ];

        $id = $cliente->getId() ?? 0;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        $this->tableGateway->update($data, ['cliente_id' => $id]);
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

    public function procuraClientes(array $filtros): ResultSet
    {
        /** @var Select $select */
        $select = $this->tableGateway->getSql()->select();

        $where = $select->where;
        $where->equalTo(ConstantesClientes::FLAG_OCULTO_NAME, 0);
        foreach ($filtros as $campo => $valor) {
            if ($valor !== null && $valor !== '') {
                if (
                    $campo === ConstantesClientes::CEP_NAME
                    || $campo === ConstantesClientes::NUMERO_NAME
                    || $campo === ConstantesClientes::CPF_NAME
                    || $campo === ConstantesClientes::RG_NAME
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

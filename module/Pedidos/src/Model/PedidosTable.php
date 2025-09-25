<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\TableGatewayInterface;
use Pedidos\Constantes\ConstantesPedidos;
use RuntimeException;

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
        $rowset = $this->tableGateway->select(['id_pedido' => $id]);
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
            ConstantesPedidos::NUMERO_PEDIDO_NAME => (int)$pedido->getNumeroPedido() ?? 0,
            ConstantesPedidos::PROFISSAO_NAME => $pedido->getProfissao() ?? '',
            ConstantesPedidos::ADM_OBRA_NAME => $pedido->getAdmObra() ?? '',
            ConstantesPedidos::TELEFONE_NAME => (int)$pedido->getTelefone() ?? 0,
            ConstantesPedidos::TELEFONE_FIXO_NAME => (int)$pedido->getTelefoneFixo() ?? 0,
            ConstantesPedidos::DESCRICAO_NAME => $pedido->getDescricao() ?? '',
            ConstantesPedidos::ACABAMENTO_NAME => $pedido->getAcabamento() ?? '',
            ConstantesPedidos::TUBOS_NAME => $pedido->getTubos() ?? '',
            ConstantesPedidos::REVESTIMENTO_NAME => $pedido->getRevestimento() ? 1 : 0,
            ConstantesPedidos::VALOR_TOTAL_NAME => (double)$pedido->getValorTotal() ?? 0,
            ConstantesPedidos::PRAZO_MONTAGEM_NAME => (int)$pedido->getPrazoMontagem() ?? 0,
            ConstantesPedidos::NUMERO_NAME => (int)$pedido->getNumero() ?? 0,
            ConstantesPedidos::BAIRRO_NAME => $pedido->getBairro() ?? '',
            ConstantesPedidos::CIDADE_NAME => $pedido->getCidade() ?? '',
            ConstantesPedidos::CEP_NAME => (int)$pedido->getCep() ?? 0,
            ConstantesPedidos::REFERENCIA_NAME => $pedido->getReferencia() ?? '',
            ConstantesPedidos::FLAG_OCULTO_NAME => $pedido->getFlagOculto() ?? 0,
            ConstantesPedidos::CLIENTE_NOME_NAME => $pedido->getClienteNome() ?? '',
            ConstantesPedidos::EMAIL_NAME => $pedido->getEmail() ?? '',
            ConstantesPedidos::CPF_NAME => (int)$pedido->getCpf() ?? 0,
            ConstantesPedidos::RG_NAME => (int)$pedido->getRg() ?? 0,
            ConstantesPedidos::CNPJ_NAME => $pedido->getCnpj() ?? '',
            ConstantesPedidos::SS_NAME => $pedido->getServicoSocial() ?? '',
            ConstantesPedidos::NUMERO_CLIENTE_NAME => (int)$pedido->getNumeroCliente() ?? 0,
            ConstantesPedidos::BAIRRO_CLIENTE_NAME => $pedido->getBairroCliente() ?? '',
            ConstantesPedidos::CIDADE_CLIENTE_NAME => $pedido->getCidadeCliente() ?? '',
            ConstantesPedidos::CEP_CLIENTE_NAME => (int)$pedido->getCepCliente() ?? 0,
            ConstantesPedidos::REFERENCIA_CLIENTE_NAME => $pedido->getReferenciaCliente() ?? '',

        ];

        $id = (int) $pedido->getId() ?? 0;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        $this->tableGateway->update($data, ['id_pedido' => $id]);
    }

    /**
     * @param int $id
     */
    public function deletePedido(int $id): void
    {
        $this->tableGateway->delete(['id_pedido' => $id]);
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
        $where->equalTo(ConstantesPedidos::FLAG_OCULTO_NAME, 0);
        foreach ($filtros as $campo => $valor) {
            if ($valor !== null && $valor !== '') {
                if (
                    $campo === 'revestimento'
                    || $campo === 'id_pedido'
                    || $campo === 'numero_pedido'
                    || $campo === 'prazo_montagem'
                    || $campo === 'numero'
                ) {
                    $where->equalTo($campo, (int) $valor);
                } else {
                    $where->like($campo, '%' . $valor . '%');
                }
            }
        }


        return $this->tableGateway->selectWith($select);
    }
}

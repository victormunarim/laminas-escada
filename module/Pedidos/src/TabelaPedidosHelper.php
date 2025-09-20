<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\TabelaHelperGenerica;
use Laminas\Db\ResultSet\ResultSetInterface;
use Pedidos\Constantes\ConstantesPedidos;
use Pedidos\Model\Pedidos;
use Pedidos\Model\PedidosTable;

class TabelaPedidosHelper extends TabelaHelperGenerica
{
    private PedidosTable $pedidosTable;

    public function __construct(PedidosTable $pedidosTable)
    {
        parent::__construct($pedidosTable);
        $this->pedidosTable = $pedidosTable;
    }

    protected function pegaRoute(): string
    {
        return ConstantesPedidos::ROUTE;
    }

    protected function pegaDados($filtros): ResultSetInterface
    {
        return $this->pedidosTable->procuraPedidos($filtros);
    }

    protected function getColunasFixas(): array
    {
        return [];
    }

    protected function getColunasIgnorar(): array
    {
        return [
            ConstantesPedidos::FLAG_OCULTO_VALUE,
            ConstantesPedidos::CLIENTE_NOME_VALUE,
        ];
    }


    protected function getMapaNomesColunas(): array
    {
        return [
            ConstantesPedidos::ID_VALUE => ConstantesPedidos::ID_LABEL,
            ConstantesPedidos::NUMERO_PEDIDO_VALUE => ConstantesPedidos::NUMERO_PEDIDO_LABEL,
            ConstantesPedidos::CLIENTE_ID_VALUE => ConstantesPedidos::CLIENTE_NOME_LABEL,
            ConstantesPedidos::PROFISSAO_VALUE => ConstantesPedidos::PROFISSAO_LABEL,
            ConstantesPedidos::EMAIL_VALUE => ConstantesPedidos::EMAIL_LABEL,
            ConstantesPedidos::ADM_OBRA_VALUE => ConstantesPedidos::ADM_OBRA_LABEL,
            ConstantesPedidos::TELEFONE_VALUE => ConstantesPedidos::TELEFONE_LABEL,
            ConstantesPedidos::TELEFONE_FIXO_VALUE => ConstantesPedidos::TELEFONE_FIXO_LABEL,
            ConstantesPedidos::DESCRICAO_VALUE => ConstantesPedidos::DESCRICAO_LABEL,
            ConstantesPedidos::ACABAMENTO_VALUE => ConstantesPedidos::ACABAMENTO_LABEL,
            ConstantesPedidos::TUBOS_VALUE => ConstantesPedidos::TUBOS_LABEL,
            ConstantesPedidos::REVESTIMENTO_VALUE => ConstantesPedidos::REVESTIMENTO_LABEL,
            ConstantesPedidos::VALOR_TOTAL_VALUE => ConstantesPedidos::VALOR_TOTAL_LABEL,
            ConstantesPedidos::PRAZO_MONTAGEM_VALUE => ConstantesPedidos::PRAZO_MONTAGEM_LABEL,
            ConstantesPedidos::NUMERO_VALUE => ConstantesPedidos::NUMERO_LABEL,
            ConstantesPedidos::BAIRRO_VALUE => ConstantesPedidos::BAIRRO_LABEL,
            ConstantesPedidos::CIDADE_VALUE => ConstantesPedidos::CIDADE_LABEL,
            ConstantesPedidos::CEP_VALUE => ConstantesPedidos::CEP_LABEL,
            ConstantesPedidos::REFERENCIA_VALUE => ConstantesPedidos::REFERENCIA_LABEL,

        ];
    }

    /**
     * @param Pedidos|array<string,mixed> $linha
     */
    protected function renderizarAcoes(Pedidos|array $linha): string
    {
        $id = null;

        if ($linha instanceof Pedidos) {
            $id = $linha->getId();
        } elseif (is_array($linha)) {
            $id = $linha['id'] ?? null;
        }

        if (empty($id)) {
            return '';
        }

        $id = $this->getView()->escapeHtml((string) $id);

        $editUrl = $this->getView()->url(ConstantesPedidos::ROUTE, [
            'action'    => 'edit',
            'id_pedido' => $id,
        ]);

        $deleteUrl = $this->getView()->url(ConstantesPedidos::ROUTE, [
            'action'    => 'delete',
            'id_pedido' => $id,
        ]);

        $pdfUrl = $this->getView()->url(ConstantesPedidos::ROUTE, [
            'action'    => 'pdf',
            'id_pedido' => $id,
        ]);

        return '<div class="btn-group">'
            . '<a href="' . $editUrl . '" class="btn btn-primary">Editar</a>'
            . '<a href="' . $deleteUrl . '" class="btn btn-danger">Excluir</a>'
            . '<a href="' . $pdfUrl . '" class="btn btn-secondary">PDF</a>'
            . '</div>';
    }
}

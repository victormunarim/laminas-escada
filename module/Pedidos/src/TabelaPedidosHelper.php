<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\TabelaHelperGenerica;
use Pedidos\Constantes\ConstantesPedidos;
use Pedidos\Model\Pedidos;

class TabelaPedidosHelper extends TabelaHelperGenerica
{
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
            ConstantesPedidos::CPF_VALUE => ConstantesPedidos::CPF_LABEL,
            ConstantesPedidos::RG_VALUE => ConstantesPedidos::RG_LABEL,
            ConstantesPedidos::PROFISSAO_VALUE => ConstantesPedidos::PROFISSAO_LABEL,
            ConstantesPedidos::CNPJ_VALUE => ConstantesPedidos::CNPJ_LABEL,
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

        return '<div class="btn-group">'
            . '<a href="' . $editUrl . '" class="btn btn-primary">Editar</a>'
            . '<a href="' . $deleteUrl . '" class="btn btn-danger">Excluir</a>'
            . '</div>';
    }
}

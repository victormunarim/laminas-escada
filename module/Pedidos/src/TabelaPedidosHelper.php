<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\TabelaHelperGenerica;
use Pedidos\Constantes\ConstantesPedidos;

class TabelaPedidosHelper extends TabelaHelperGenerica
{
    protected function getColunasFixas(): array
    {
        return [
            ConstantesPedidos::ID_NAME,
            ConstantesPedidos::NUMERO_PEDIDO_NAME,
            ConstantesPedidos::CLIENTE_ID_NAME,
            ConstantesPedidos::CPF_NAME,
            ConstantesPedidos::RG_NAME,
            ConstantesPedidos::PROFISSAO_NAME,
            ConstantesPedidos::CNPJ_NAME,
            ConstantesPedidos::EMAIL_NAME,
            ConstantesPedidos::ADM_OBRA_NAME,
            ConstantesPedidos::TELEFONE_NAME,
            ConstantesPedidos::TELEFONE_FIXO_NAME,
            ConstantesPedidos::DESCRICAO_NAME,
            ConstantesPedidos::REVESTIMENTO_NAME,
            ConstantesPedidos::VALOR_TOTAL_NAME,
            ConstantesPedidos::PRAZO_MONTAGEM_NAME,

        ];
    }

    protected function getColunasIgnorar(): array
    {
        return ['inputFilter'];
    }

    protected function getMapaNomesColunas(): array
    {
        return [
            ConstantesPedidos::ID_NAME => ConstantesPedidos::ID_LABEL,
            ConstantesPedidos::NUMERO_PEDIDO_NAME => ConstantesPedidos::NUMERO_PEDIDO_LABEL,
            ConstantesPedidos::CLIENTE_ID_NAME => ConstantesPedidos::CLIENTE_ID_LABEL,
            ConstantesPedidos::CPF_NAME => ConstantesPedidos::CPF_LABEL,
            ConstantesPedidos::RG_NAME => ConstantesPedidos::RG_LABEL,
            ConstantesPedidos::PROFISSAO_NAME => ConstantesPedidos::PROFISSAO_LABEL,
            ConstantesPedidos::CNPJ_NAME => ConstantesPedidos::CNPJ_LABEL,
            ConstantesPedidos::EMAIL_NAME => ConstantesPedidos::EMAIL_LABEL,
            ConstantesPedidos::ADM_OBRA_NAME => ConstantesPedidos::ADM_OBRA_LABEL,
            ConstantesPedidos::TELEFONE_NAME => ConstantesPedidos::TELEFONE_LABEL,
            ConstantesPedidos::TELEFONE_FIXO_NAME => ConstantesPedidos::TELEFONE_FIXO_LABEL,
            ConstantesPedidos::DESCRICAO_NAME => ConstantesPedidos::DESCRICAO_LABEL,
            ConstantesPedidos::REVESTIMENTO_NAME => ConstantesPedidos::REVESTIMENTO_LABEL,
            ConstantesPedidos::VALOR_TOTAL_NAME => ConstantesPedidos::VALOR_TOTAL_LABEL,
            ConstantesPedidos::PRAZO_MONTAGEM_NAME => ConstantesPedidos::PRAZO_MONTAGEM_LABEL,

        ];
    }

    protected function renderizarAcoes(object|array $linha): string
    {
        $id = $this->getView()->escapeHtml((string) ($linha['id_pedido'] ?? ($linha->id ?? '')));

        if (! $id) {
            return '';
        }

        $editUrl = $this->getView()->url(ConstantesPedidos::ROUTE, ['action' => 'edit', 'id_pedido' => $id]);
        $deleteUrl = $this->getView()->url(ConstantesPedidos::ROUTE, ['action' => 'delete', 'id_pedido' => $id]);

        $html = '<div class="btn-group">';
        $html .= '<a href="' . $editUrl . '" class="btn btn-primary">';
        $html .= '<i class="fas fa-edit"></i> Editar</a>';
        $html .= '<a href="' . $deleteUrl . '" class="btn btn-danger">';
        $html .= '<i class="fas fa-trash"></i> Excluir</a>';
        $html .= '</div>';

        return $html;
    }
}

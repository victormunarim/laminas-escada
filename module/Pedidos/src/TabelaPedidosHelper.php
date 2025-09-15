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
            ConstantesPedidos::NOME_NAME,
            ConstantesPedidos::IDADE_NAME,
            ConstantesPedidos::DATA_NAME
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
            ConstantesPedidos::NOME_NAME => ConstantesPedidos::NOME_LABEL,
            ConstantesPedidos::IDADE_NAME => ConstantesPedidos::IDADE_LABEL,
            ConstantesPedidos::DATA_NAME => ConstantesPedidos::DATA_LABEL,
        ];
    }

    protected function renderizarAcoes(object|array $linha): string
    {
        $id = $this->getView()->escapeHtml((string) ($linha['id'] ?? ($linha->id ?? '')));

        if (! $id) {
            return '';
        }

        $editUrl = $this->getView()->url(ConstantesPedidos::ROUTE, ['action' => 'edit', 'id' => $id]);
        $deleteUrl = $this->getView()->url(ConstantesPedidos::ROUTE, ['action' => 'delete', 'id' => $id]);

        $html = '<div class="btn-group">';
        $html .= '<a href="' . $editUrl . '" class="btn btn-primary">';
        $html .= '<i class="fas fa-edit"></i> Editar</a>';
        $html .= '<a href="' . $deleteUrl . '" class="btn btn-danger">';
        $html .= '<i class="fas fa-trash"></i> Excluir</a>';
        $html .= '</div>';

        return $html;
    }
}

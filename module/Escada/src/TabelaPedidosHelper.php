<?php

declare(strict_types=1);

namespace Escada;

use Application\View\Helper\TabelaHelperGenerica;

class TabelaPedidosHelper extends TabelaHelperGenerica
{
    protected function getColunasFixas(): array
    {
        return ['id', 'nome', 'idade'];
    }

    protected function getColunasIgnorar(): array
    {
        return ['inputFilter'];
    }

    protected function getMapaNomesColunas(): array
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'idade' => 'Idade',
        ];
    }

    protected function renderizarAcoes(object|array $linha): string
    {
        $id = $this->getView()->escapeHtml((string) ($linha['id'] ?? ($linha->id ?? '')));

        if (! $id) {
            return '';
        }

        $editUrl = $this->getView()->url('escada', ['action' => 'edit', 'id' => $id]);
        $deleteUrl = $this->getView()->url('escada', ['action' => 'delete', 'id' => $id]);

        $html = '<div class="btn-group">';
        $html .= '<a href="' . $editUrl . '" class="btn btn-primary">';
        $html .= '<i class="fas fa-edit"></i> Editar</a>';
        $html .= '<a href="' . $deleteUrl . '" class="btn btn-danger">';
        $html .= '<i class="fas fa-trash"></i> Excluir</a>';
        $html .= '</div>';

        return $html;
    }
}

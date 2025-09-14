<?php

namespace Escada;

use Laminas\View\Helper\AbstractHelper;

class BarraPesquisaHelper extends AbstractHelper
{
    public function __invoke($searchTerm = null, $routeName = 'escada', $addButton = true, $title = null)
    {
        $html = '';

        if ($title !== null) {
            $html .= '<h5>' . $this->getView()->escapeHtml($title) . '</h5>';
        }

        $html .= '<div class="row mb-4">';

        $html .= '<div class="' . ($addButton ? 'col-md-6' : 'col-md-12') . '">';
        $html .= $this->renderSearchBar($searchTerm, $routeName);
        $html .= '</div>';

        if ($addButton) {
            $html .= '<div class="col-md-6 text-right">';
            $html .= $this->renderAddButton($routeName);
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    private function renderSearchBar($searchTerm, $routeName)
    {
        $url = $this->getView()->url($routeName);
        $searchValue = $this->getView()->escapeHtml($searchTerm ?? '');

        $html = '<form action="' . $url . '" method="get" class="form-inline">';
        $html .= '<div class="input-group">';
        $html .= '<input type="text"';
        $html .= '       name="search"';
        $html .= '       class="form-control"';
        $html .= '       placeholder="Digite o nome do pedido..."';
        $html .= '       value="' . $searchValue . '">';
        $html .= '<div class="input-group-append">';
        $html .= '<button type="submit" class="btn btn-primary">';
        $html .= '<i class="fas fa-search"></i> Pesquisar';
        $html .= '</button>';

        // Botão limpar apenas se houver termo de pesquisa
        if (!empty($searchTerm)) {
            $html .= '<a href="' . $url . '" class="btn btn-secondary ml-2">';
            $html .= '<i class="fas fa-times"></i> Limpar';
            $html .= '</a>';
        }

        $html .= '</div>'; // input-group-append
        $html .= '</div>'; // input-group
        $html .= '</form>';

        return $html;
    }

    private function renderAddButton($routeName)
    {
        $url = $this->getView()->url($routeName, ['action' => 'add']);

        $html = '<a href="' . $url . '" class="btn btn-success">';
        $html .= '<i class="fas fa-plus"></i> Novo Pedido';
        $html .= '</a>';

        return $html;
    }
}
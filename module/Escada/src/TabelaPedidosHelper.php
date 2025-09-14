<?php

namespace Escada;

use Laminas\View\Helper\AbstractHelper;

class TabelaPedidosHelper extends AbstractHelper
{
    public function __invoke($pedidos)
    {
        if (count($pedidos) === 0) {
            $addUrl = $this->getView()->url('escada', ['action' => 'add']);
            return '<h1>Pedidos</h1>
                    <p>Nenhum pedido encontrado. <a href="' . $addUrl . '">Adicionar primeiro pedido</a></p>';
        }

        $html = '<table class="table table-striped">';

        $html .= '<tr><th>ID</th><th>Nome</th><th>Ações</th></tr>';

        foreach ($pedidos as $pedido) {
            $editUrl = $this->getView()->url('escada', ['action' => 'edit', 'id' => $pedido->getId()]);
            $deleteUrl = $this->getView()->url('escada', ['action' => 'delete', 'id' => $pedido->getId()]);

            $html .= '<tr>';
            $html .= '<td>' . $this->getView()->escapeHtml($pedido->getId()) . '</td>';
            $html .= '<td>' . $this->getView()->escapeHtml($pedido->getNome()) . '</td>';
            $html .= '<td>';
            $html .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Editar</a> ';
            $html .= '<a href="' . $deleteUrl . '" class="btn btn-danger btn-sm">Excluir</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        return $html;
    }
}
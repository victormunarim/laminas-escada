<?php

declare(strict_types=1);

namespace Escada;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\View\Helper\AbstractHelper;

class TabelaPedidosHelper extends AbstractHelper
{
    public function __invoke($pedidos)
    {
        if ($pedidos instanceof ResultSet) {
            $pedidosArray = [];
            foreach ($pedidos as $pedido) {
                $pedidosArray[] = $pedido;
            }
            $pedidos = $pedidosArray;
        }

        if (count($pedidos) === 0) {
            return '';
        }

        $primeiroPedido = $pedidos[0];
        $colunas = $this->getColunasDisponiveis($primeiroPedido);

        $html = '<div class="table-responsive">';
        $html .= '<table class="table table-striped table-hover">';

        $html .= '<thead class="thead-dark">';
        $html .= '<tr>';
        foreach ($colunas as $coluna) {
            $html .= '<th>' . $this->formatarNomeColuna($coluna) . '</th>';
        }
        $html .= '<th>Ações</th>';
        $html .= '</tr>';
        $html .= '</thead>';

        $html .= '<tbody>';

        foreach ($pedidos as $pedido) {
            $html .= '<tr>';

            foreach ($colunas as $coluna) {
                $valor = $this->getValorColuna($pedido, $coluna);
                $html .= '<td>' . $this->getView()->escapeHtml($valor) . '</td>';
            }

            $html .= '<td>' . $this->renderAcoes($pedido) . '</td>';

            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';

        return $html;
    }

    private function getColunasDisponiveis($pedido)
    {
        $colunasFixas = ['id', 'nome', 'idade'];

        if (is_object($pedido)) {
            $reflection = new \ReflectionClass($pedido);
            $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

            foreach ($properties as $property) {
                if (!in_array($property->getName(), $colunasFixas)) {
                    $colunasFixas[] = $property->getName();
                }
            }
        } elseif (is_array($pedido)) {
            $colunasFixas = array_merge($colunasFixas, array_keys($pedido));
        }

        $colunasIgnorar = ['inputFilter'];
        $colunasFixas = array_diff($colunasFixas, $colunasIgnorar);

        return array_unique(array_values($colunasFixas));
    }

    private function formatarNomeColuna($coluna)
    {
        $mapaNomes = [
            'id' => 'ID',
            'nome' => 'Nome',
            'idade' => 'Idade'
        ];

        return $mapaNomes[$coluna] ?? ucfirst($coluna);
    }

    private function getValorColuna($pedido, $coluna)
    {
        if (is_object($pedido)) {
            $getter = 'get' . ucfirst($coluna);
            if (method_exists($pedido, $getter)) {
                return $pedido->$getter();
            }

            if (property_exists($pedido, $coluna)) {
                return $pedido->$coluna;
            }

            if ($pedido instanceof \ArrayAccess && isset($pedido[$coluna])) {
                return $pedido[$coluna];
            }
        } elseif (is_array($pedido) && isset($pedido[$coluna])) {
            return $pedido[$coluna];
        }

        return '';
    }

    private function renderAcoes($pedido)
    {
        $id = $this->getValorColuna($pedido, 'id');

        if (! $id) {
            return '';
        }

        $editUrl = $this->getView()->url('escada', ['action' => 'edit', 'id' => $id]);
        $deleteUrl = $this->getView()->url('escada', ['action' => 'delete', 'id' => $id]);

        $html = '<div class="btn-group">';
        $html .= '<a href="' . $editUrl . '" class="btn btn-primary">';
        $html .= '<i class="fas fa-edit"></i> Editar';
        $html .= '</a>';
        $html .= '<a href="' . $deleteUrl . '" class="btn btn-danger">';
        $html .= '<i class="fas fa-trash"></i> Excluir';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }
}

<?php

declare(strict_types=1);

namespace Escada;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\View\Helper\AbstractHelper;

class TabelaPedidosHelper extends AbstractHelper
{
    /**
     * @param ResultSet|array<int, object|array<string, mixed>> $pedidos
     */
    public function __invoke(ResultSet|array $pedidos): string
    {
        if ($pedidos instanceof ResultSet) {
            $pedidos = iterator_to_array($pedidos);
        }

        if (count($pedidos) === 0) {
            return '';
        }

        $primeiroPedido = $pedidos[0];
        $colunas = $this->getColunasDisponiveis($primeiroPedido);

        $html = '<div class="table-responsive">';
        $html .= '<table class="table table-striped table-hover">';
        $html .= '<thead class="thead-dark"><tr>';

        foreach ($colunas as $coluna) {
            $html .= '<th>' . $this->formatarNomeColuna($coluna) . '</th>';
        }

        $html .= '<th>Ações</th></tr></thead><tbody>';

        foreach ($pedidos as $pedido) {
            $html .= '<tr>';
            foreach ($colunas as $coluna) {
                $valor = $this->getValorColuna($pedido, $coluna);
                $html .= '<td>' . $this->getView()->escapeHtml((string) $valor) . '</td>';
            }
            $html .= '<td>' . $this->renderAcoes($pedido) . '</td></tr>';
        }

        $html .= '</tbody></table></div>';

        return $html;
    }

    /**
     * @param object|array<string, mixed> $pedido
     * @return array<int, string>
     */
    private function getColunasDisponiveis(object|array $pedido): array
    {
        $colunasFixas = ['id', 'nome', 'idade'];

        if (is_object($pedido)) {
            $reflection = new \ReflectionClass($pedido);
            foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
                if (!in_array($property->getName(), $colunasFixas, true)) {
                    $colunasFixas[] = $property->getName();
                }
            }
        } elseif (is_array($pedido)) {
            $colunasFixas = array_merge($colunasFixas, array_keys($pedido));
        }

        $colunasIgnorar = ['inputFilter'];
        $colunasFixas = array_diff($colunasFixas, $colunasIgnorar);

        return array_values(array_unique($colunasFixas));
    }

    private function formatarNomeColuna(string $coluna): string
    {
        $mapaNomes = [
            'id' => 'ID',
            'nome' => 'Nome',
            'idade' => 'Idade',
        ];

        return $mapaNomes[$coluna] ?? ucfirst($coluna);
    }

    /**
     * @param object|array<string, mixed> $pedido
     * @return mixed
     */
    private function getValorColuna(object|array $pedido, string $coluna): mixed
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

        return null;
    }

    /**
     * @param object|array<string, mixed> $pedido
     */
    private function renderAcoes(object|array $pedido): string
    {
        $id = $this->getValorColuna($pedido, 'id');

        if (!$id) {
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

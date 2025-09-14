<?php

declare(strict_types=1);

namespace Escada;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\View\Helper\AbstractHelper;

class MensagensAlertHelper extends AbstractHelper
{
    /**
     * @param ResultSet|array<int, mixed> $pedidos
     */
    public function __invoke(
        ResultSet|array $pedidos = [],
        ?string $searchTerm = null,
        string $routeName = 'escada'
    ): string {
        $isEmpty = $pedidos instanceof ResultSet
            ? $pedidos->count() === 0
            : count($pedidos) === 0;

        $html = '';

        if (! empty($searchTerm) && $isEmpty) {
            $html .= $this->renderAlertInfo($searchTerm, $routeName);
        }

        if ($searchTerm === null && $isEmpty) {
            $html .= $this->renderAlertWarning($routeName);
        }

        return $html;
    }

    private function renderAlertInfo(string $searchTerm, string $routeName): string
    {
        $url = $this->getView()->url($routeName);
        $termo = $this->getView()->escapeHtml($searchTerm);

        $html = '<div class="alert alert-info mt-3">';
        $html .= '<i class="fas fa-info-circle"></i> ';
        $html .= 'Nenhum pedido encontrado para "' . $termo . '". ';
        $html .= '<a href="' . $url . '" class="alert-link">Ver todos os pedidos</a>';
        $html .= '</div>';

        return $html;
    }

    private function renderAlertWarning(string $routeName): string
    {
        $url = $this->getView()->url($routeName, ['action' => 'add']);

        $html = '<div class="alert alert-warning mt-3">';
        $html .= '<i class="fas fa-exclamation-triangle"></i> ';
        $html .= 'Nenhum pedido cadastrado. ';
        $html .= '<a href="' . $url . '" class="alert-link">Cadastrar primeiro pedido</a>';
        $html .= '</div>';

        return $html;
    }
}

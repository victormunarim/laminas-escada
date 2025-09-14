<?php

namespace Escada;

use Laminas\View\Helper\AbstractHelper;

class MensagensAlertHelper extends AbstractHelper
{
    public function __invoke($pedidos = [], $searchTerm = null, $routeName = 'escada')
    {
        $html = '';

        if (!empty($searchTerm) && count($pedidos) === 0) {
            $html .= $this->renderAlertInfo($searchTerm, $routeName);
        }

        if (empty($searchTerm) && count($pedidos) === 0) {
            $html .= $this->renderAlertWarning($routeName);
        }

        return $html;
    }

    private function renderAlertInfo($searchTerm, $routeName)
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

    private function renderAlertWarning($routeName)
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
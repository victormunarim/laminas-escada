<?php

declare(strict_types=1);

namespace Pedidos;

use Laminas\Form\View\Helper\AbstractHelper;

class FormDeletePedidosHelper extends AbstractHelper
{
    public function __invoke(string $title, string $route, int $id, string $nomeCliente): string
    {
        $view = $this->getView();

        $url = $view->url($route, ['action' => 'delete', 'id_pedido' => $id]);

        $html  = '<h1>' . $view->escapeHtml($title) . '</h1>';
        $html .= '<p>Tem certeza que deseja excluir o pedido de ' . $view->escapeHtml($nomeCliente) . '?</p>';
        $html .= '<form action="' . $url . '" method="post">';
        $html .= '  <div class="form-group">';
        $html .= '    <input type="hidden" name="id" value="' . (int) $id . '" />';
        $html .= '    <button type="submit" class="btn btn-danger" name="deleteStatus" value="1">Yes</button>';
        $html .= '    <button type="submit" class="btn btn-success" name="deleteStatus" value="0">No</button>';
        $html .= '  </div>';
        $html .= '</form>';

        return $html;
    }
}

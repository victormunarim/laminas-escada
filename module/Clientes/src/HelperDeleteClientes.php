<?php

declare(strict_types=1);

namespace Clientes;

use Clientes\Model\Clientes;
use Laminas\View\Helper\AbstractHelper;

class HelperDeleteClientes extends AbstractHelper
{
    public function __invoke(
        string $title,
        string $route,
        Clientes $cliente
    ): string {
        $view = $this->getView();

        $url = $view->url($route, ['action' => 'delete', 'cliente_id' => $cliente->getId()]);

        $html  = '<h1>' . $view->escapeHtml($title) . '</h1>';
        $html .= '<p>Tem certeza que deseja excluir o cliente: ' . $view->escapeHtml($cliente->getNome()) . '?</p>';
        $html .= '<form action="' . $url . '" method="post">';
        $html .= '  <div class="form-group">';
        $html .= '    <input type="hidden" name="id" value="' . (int) $cliente->getId() . '" />';
        $html .= '    <button type="submit" class="btn btn-danger" name="deleteStatus" value="1">Yes</button>';
        $html .= '    <button type="submit" class="btn btn-success" name="deleteStatus" value="0">No</button>';
        $html .= '  </div>';
        $html .= '</form>';

        return $html;
    }
}

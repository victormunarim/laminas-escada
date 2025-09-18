<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class FormDeleteHelperGenerico extends AbstractHelper
{
    public function __invoke(
        string $title,
        string $route,
        int $id,
        string $nomeCliente
    ): string {
        $view = $this->getView();

        $url = $view->url($route, ['action' => 'delete', 'id' => $id]);

        $html  = '<h1>' . $view->escapeHtml($title) . '</h1>';
        $html .= '<p>Tem certeza que deseja excluir o pedido de ' . $nomeCliente . '?</p>';
        $html .= '<form action="' . $url . '" method="post">';
        $html .= '  <div class="form-group">';
        $html .= '    <input type="hidden" name="id" value="' . (int) $id . '" />';
        $html .= '    <input type="submit" class="btn btn-danger" name="del" value="Yes" />';
        $html .= '    <input type="submit" class="btn btn-success" name="del" value="No" />';
        $html .= '  </div>';
        $html .= '</form>';

        return $html;
    }
}

<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\View\Helper\AbstractHelper;
use Pedidos\Constantes\ConstantesPedidos;

abstract class MensagensAlertHelperGenerica extends AbstractHelper
{
    /**
     * @param ResultSet|array<int, mixed> $dados
     */
    public function __invoke(
        ResultSet|array $dados = [],
        ?array $searchTerm = null,
        string $routeName = ConstantesPedidos::ROUTE
    ): string {
        $isEmpty = $dados instanceof ResultSet
            ? $dados->count() === 0
            : count($dados) === 0;

        $html = '';

        if ((! empty($searchTerm) || $searchTerm === null) && $isEmpty) {
            $html .= $this->renderAlertWarning($routeName);
        }

        return $html;
    }

    protected function renderAlertWarning(string $routeName): string
    {
        $url = $this->getView()->url($routeName, ['action' => 'add']);

        $html = '<div class="alert alert-warning mt-3">';
        $html .= '<i class="fas fa-exclamation-triangle"></i> ';
        $html .= $this->getMensagemWarning($url);
        $html .= '</div>';

        return $html;
    }

    abstract protected function getMensagemWarning(string $url): string;
}

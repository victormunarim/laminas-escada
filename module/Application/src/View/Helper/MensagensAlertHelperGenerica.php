<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\View\Helper\AbstractHelper;

abstract class MensagensAlertHelperGenerica extends AbstractHelper
{
    /**
     * @param ResultSet|array<int, mixed> $dados
     */
    public function __invoke(
        ResultSet|array $dados = [],
        ?string $searchTerm = null,
        string $routeName = 'Pedidos'
    ): string {
        $isEmpty = $dados instanceof ResultSet
            ? $dados->count() === 0
            : count($dados) === 0;

        $html = '';

        if (! empty($searchTerm) && $isEmpty) {
            $html .= $this->renderAlertInfo($searchTerm, $routeName);
        }

        if ($searchTerm === null && $isEmpty) {
            $html .= $this->renderAlertWarning($routeName);
        }

        return $html;
    }

    protected function renderAlertInfo(string $searchTerm, string $routeName): string
    {
        $url = $this->getView()->url($routeName);
        $termo = $this->getView()->escapeHtml($searchTerm);

        $html = '<div class="alert alert-info mt-3">';
        $html .= '<i class="fas fa-info-circle"></i> ';
        $html .= $this->getMensagemInfo($termo, $url);
        $html .= '</div>';

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

    abstract protected function getMensagemInfo(string $termo, string $url): string;

    abstract protected function getMensagemWarning(string $url): string;
}

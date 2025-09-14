<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\View\Helper\AbstractHelper;

abstract class BarraPesquisaHelperGenerica extends AbstractHelper
{
    /**
     * @param array<string, mixed> $opcoes
     */
    public function __invoke(array $opcoes = []): string
    {
        $opcoes = array_merge($this->getPadroes(), $opcoes);

        $html = '';

        if ($opcoes['titulo'] !== null) {
            $html .= '<h5 class="mb-3">' . $this->getView()->escapeHtml($opcoes['titulo']) . '</h5>';
        }

        $html .= '<div class="row mb-4">';
        $html .= '<div class="col-md-12">';
        $html .= $this->renderizarCamposPesquisa($opcoes);
        $html .= '</div>';

        if ($opcoes['mostrarBotaoAdicionar']) {
            $html .= '<div class="col-md-12 mt-3">';
            $html .= $this->renderizarBotaoAdicionar($opcoes);
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * @return array<string, mixed>
     */
    abstract protected function getPadroes(): array;

    /**
     * @param array<string, mixed> $opcoes
     */
    protected function renderizarCamposPesquisa(array $opcoes): string
    {
        $url = $this->getView()->url($opcoes['nomeRota']);

        $html = '<form action="' . $url . '" method="get">';
        $html .= '<div class="row g-3 align-items-end">';

        foreach ($opcoes['campos'] as $nomeCampo => $configCampo) {
            $html .= $this->renderizarCampo($nomeCampo, $configCampo, $opcoes);
        }

        $html .= '<div class="col-auto">';
        $html .= '<div class="d-flex gap-2">';
        $html .= '<button type="submit" class="btn btn-primary">';
        $html .= '<i class="fas fa-search"></i> Pesquisar</button>';

        if ($this->temValoresPesquisa($opcoes['campos'])) {
            $html .= '<a href="' . $url . '" class="btn btn-secondary">';
            $html .= '<i class="fas fa-times"></i> Limpar</a>';
        }

        $html .= '</div></div>';
        $html .= '</div></form>';

        return $html;
    }

    /**
     * @param string $nomeCampo
     * @param array<string, mixed> $configCampo
     * @param array<string, mixed> $opcoes
     */
    protected function renderizarCampo(string $nomeCampo, array $configCampo, array $opcoes): string
    {
        $valor = $configCampo['valor'] ?? $this->getView()->escapeHtml($opcoes['termoPesquisa'] ?? '');

        $html = '<div class="col-auto">';
        $html .= '<label for="' . $nomeCampo . '" class="form-label">' .
            $this->getView()->escapeHtml($configCampo['label']) . '</label>';
        $html .= '<input type="text"';
        $html .= ' id="' . $nomeCampo . '"';
        $html .= ' name="' . $nomeCampo . '"';
        $html .= ' class="form-control"';
        $html .= ' placeholder="' . $this->getView()->escapeHtml($configCampo['placeholder']) . '"';
        $html .= ' value="' . $valor . '">';
        $html .= '</div>';

        return $html;
    }

    /**
     * @param array<string, array<string, mixed>> $campos
     */
    protected function temValoresPesquisa(array $campos): bool
    {
        foreach ($campos as $configCampo) {
            if (! empty($configCampo['valor'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array<string, mixed> $opcoes
     */
    protected function renderizarBotaoAdicionar(array $opcoes): string
    {
        $url = $this->getView()->url($opcoes['nomeRota'], ['action' => 'add']);

        $html = '<div class="d-flex align-items-end h-100">';
        $html .= '<a href="' . $url . '" class="btn btn-success">';
        $html .= '<i class="fas fa-plus"></i> ' . $this->getView()->escapeHtml($opcoes['textoBotaoAdicionar']);
        $html .= '</a></div>';

        return $html;
    }
}

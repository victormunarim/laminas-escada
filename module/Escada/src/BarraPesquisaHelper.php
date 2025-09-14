<?php

declare(strict_types=1);

namespace Escada;

use Laminas\View\Helper\AbstractHelper;

class BarraPesquisaHelper extends AbstractHelper
{
    public function __invoke($opcoes = [])
    {
        $padroes = [
            'termoPesquisa' => null,
            'nomeRota' => 'escada',
            'mostrarBotaoAdicionar' => true,
            'titulo' => null,
            'campos' => [
                'nome' => [
                    'rotulo' => 'Nome',
                    'placeholder' => 'Digite o nome...',
                    'valor' => null
                ],
                'idade' => [
                    'rotulo' => 'Idade',
                    'placeholder' => 'Digite a idade...',
                    'valor' => null
                ]
            ],
            'textoBotaoAdicionar' => 'Novo Pedido'
        ];

        $opcoes = array_merge($padroes, $opcoes);

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

    private function renderizarCamposPesquisa($opcoes)
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
        $html .= '<i class="fas fa-search"></i> Pesquisar';
        $html .= '</button>';

        if ($this->temValoresPesquisa($opcoes['campos'])) {
            $html .= '<a href="' . $url . '" class="btn btn-secondary">';
            $html .= '<i class="fas fa-times"></i> Limpar';
            $html .= '</a>';
        }

        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</form>';

        return $html;
    }

    private function renderizarCampo($nomeCampo, $configCampo, $opcoes)
    {
        $valor = $configCampo['valor'] ?? $this->getView()->escapeHtml($opcoes['termoPesquisa'] ?? '');

        $html = '<div class="col-auto">';
        $html .= '<label for="' . $nomeCampo . '" class="form-label">' .
            $this->getView()->escapeHtml($configCampo['label']) . '</label>';
        $html .= '<input type="text"';
        $html .= '       id="' . $nomeCampo . '"';
        $html .= '       name="' . $nomeCampo . '"';
        $html .= '       class="form-control"';
        $html .= '       placeholder="' . $this->getView()->escapeHtml($configCampo['placeholder']) . '"';
        $html .= '       value="' . $valor . '">';
        $html .= '</div>';

        return $html;
    }

    private function temValoresPesquisa($campos)
    {
        foreach ($campos as $configCampo) {
            if (!empty($configCampo['valor'])) {
                return true;
            }
        }
        return false;
    }

    private function renderizarBotaoAdicionar($opcoes)
    {
        $url = $this->getView()->url($opcoes['nomeRota'], ['action' => 'add']);

        $html = '<div class="d-flex align-items-end h-100">';
        $html .= '<a href="' . $url . '" class="btn btn-success">';
        $html .= '<i class="fas fa-plus"></i> ' . $this->getView()->escapeHtml($opcoes['textoBotaoAdicionar']);
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }
}
<?php

declare(strict_types=1);

namespace Escada;

use Application\View\Helper\BarraPesquisaHelperGenerica;

class BarraPesquisaHelper extends BarraPesquisaHelperGenerica
{
    /**
     * @return array<string, mixed>
     */
    protected function getPadroes(): array
    {
        return [
            'termoPesquisa' => null,
            'nomeRota' => 'escada',
            'mostrarBotaoAdicionar' => true,
            'titulo' => null,
            'campos' => [
                'nome' => [
                    'label' => 'Nome',
                    'placeholder' => 'Digite o nome...',
                    'valor' => null,
                ],
                'idade' => [
                    'label' => 'Idade',
                    'placeholder' => 'Digite a idade...',
                    'valor' => null,
                ],
            ],
            'textoBotaoAdicionar' => 'Novo Pedido',
        ];
    }
}

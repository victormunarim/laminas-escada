<?php

declare(strict_types=1);

namespace Pedidos;

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
            'nomeRota' => 'Pedidos',
            'mostrarBotaoAdicionar' => true,
            'titulo' => null,
            'campos' => [
                'nome' => [
                    'label' => 'Nome',
                    'placeholder' => 'Digite o nome...',
                    'valor' => null,
                    'type' => 'text',
                ],
                'idade' => [
                    'label' => 'Idade',
                    'placeholder' => 'Digite a idade...',
                    'valor' => null,
                    'type' => 'number',
                ],
            ],
            'textoBotaoAdicionar' => 'Novo Pedido',
        ];
    }
}

<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\BarraPesquisaHelperGenerica;
use Pedidos\Constantes\ConstantesPedidos;

class BarraPesquisaHelper extends BarraPesquisaHelperGenerica
{
    /**
     * @return array<string, mixed>
     */
    protected function getPadroes(): array
    {
        return [
            'termoPesquisa' => null,
            'nomeRota' => ConstantesPedidos::ROUTE,
            'mostrarBotaoAdicionar' => true,
            'titulo' => null,
            'campos' => [
                ConstantesPedidos::NOME_NAME => [
                    'label' => ConstantesPedidos::NOME_LABEL,
                    'placeholder' => 'Digite o nome...',
                    'valor' => null,
                    'type' => 'text',
                ],
                ConstantesPedidos::IDADE_NAME => [
                    'label' => ConstantesPedidos::IDADE_LABEL,
                    'placeholder' => 'Digite a idade...',
                    'valor' => null,
                    'type' => 'number',
                ],
                ConstantesPedidos::DATA_NAME => [
                    'label' => ConstantesPedidos::DATA_LABEL,
                    'valor' => null,
                    'type' => 'date',
                ]
            ],
            'textoBotaoAdicionar' => 'Novo Pedido',
        ];
    }
}

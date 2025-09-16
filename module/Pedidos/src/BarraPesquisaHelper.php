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
                ConstantesPedidos::ID_NAME => [
                    'label' => ConstantesPedidos::ID_LABEL,
                    'valor' => null,
                    'type' => 'number',
                ],
                ConstantesPedidos::NUMERO_PEDIDO_NAME => [
                    'label' => ConstantesPedidos::NUMERO_PEDIDO_LABEL,
                    'valor' => null,
                    'type' => 'number',
                ],
                ConstantesPedidos::CLIENTE_ID_NAME => [
                    'label' => ConstantesPedidos::CLIENTE_ID_LABEL,
                    'valor' => null,
                    'type' => 'number',
                ],
                ConstantesPedidos::CPF_NAME => [
                    'label' => ConstantesPedidos::CPF_LABEL,
                    'valor' => null,
                    'type' => 'number',
                ],
                ConstantesPedidos::RG_NAME => [
                    'label' => ConstantesPedidos::RG_LABEL,
                    'valor' => null,
                    'type' => 'number',
                ],
                ConstantesPedidos::PROFISSAO_NAME => [
                    'label' => ConstantesPedidos::PROFISSAO_LABEL,
                    'valor' => null,
                    'type' => 'text',
                ],
                ConstantesPedidos::CNPJ_NAME => [
                    'label' => ConstantesPedidos::CNPJ_LABEL,
                    'valor' => null,
                    'type' => 'text',
                ],
                ConstantesPedidos::EMAIL_NAME => [
                    'label' => ConstantesPedidos::EMAIL_LABEL,
                    'valor' => null,
                    'type' => 'email',
                ],
                ConstantesPedidos::ADM_OBRA_NAME => [
                    'label' => ConstantesPedidos::ADM_OBRA_LABEL,
                    'valor' => null,
                    'type' => 'text',
                ],
                ConstantesPedidos::TELEFONE_NAME => [
                    'label' => ConstantesPedidos::TELEFONE_LABEL,
                    'valor' => null,
                    'type' => 'tel',
                ],
                ConstantesPedidos::TELEFONE_FIXO_NAME => [
                    'label' => ConstantesPedidos::TELEFONE_FIXO_LABEL,
                    'valor' => null,
                    'type' => 'tel',
                ],
                ConstantesPedidos::DESCRICAO_NAME => [
                    'label' => ConstantesPedidos::DESCRICAO_LABEL,
                    'valor' => null,
                    'type' => 'text',
                ],
                ConstantesPedidos::REVESTIMENTO_NAME => [
                    'label' => ConstantesPedidos::REVESTIMENTO_LABEL,
                    'valor' => null,
                    'type' => 'checkbox',
                ],
                ConstantesPedidos::VALOR_TOTAL_NAME => [
                    'label' => ConstantesPedidos::VALOR_TOTAL_LABEL,
                    'valor' => null,
                    'type' => 'number',
                ],
                ConstantesPedidos::PRAZO_MONTAGEM_NAME => [
                    'label' => ConstantesPedidos::PRAZO_MONTAGEM_LABEL,
                    'valor' => null,
                    'type' => 'number',
                ]
            ],
            'textoBotaoAdicionar' => 'Novo Pedido',
        ];
    }
}

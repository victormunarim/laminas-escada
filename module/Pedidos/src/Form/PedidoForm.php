<?php

declare(strict_types=1);

namespace Pedidos\Form;

use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Tel;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator\Callback;
use Pedidos\Constantes\ConstantesPedidos;

class PedidoForm extends Form implements InputFilterProviderInterface
{

    /**
     * @param string|null $name
     */
    public function __construct()
    {
        parent::__construct(ConstantesPedidos::ROUTE);

        $this->add([
            'name' => ConstantesPedidos::ID_NAME,
            'type' => Hidden::class,
        ]);

        $this->add([
            'name' => ConstantesPedidos::NUMERO_PEDIDO_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::NUMERO_PEDIDO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CLIENTE_NOME_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::CLIENTE_NOME_LABEL
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::EMAIL_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::EMAIL_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CPF_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::CPF_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::RG_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::RG_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CNPJ_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::CNPJ_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::SS_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::SS_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::NUMERO_CLIENTE_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::NUMERO_CLIENTE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::BAIRRO_CLIENTE_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::BAIRRO_CLIENTE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CIDADE_CLIENTE_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::CIDADE_CLIENTE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CEP_CLIENTE_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::CEP_CLIENTE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::REFERENCIA_CLIENTE_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::REFERENCIA_CLIENTE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::PROFISSAO_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::PROFISSAO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::ADM_OBRA_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::ADM_OBRA_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::TELEFONE_NAME,
            'type' => Tel::class,
            'options' => [
                'label' => ConstantesPedidos::TELEFONE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::TELEFONE_FIXO_NAME,
            'type' => Tel::class,
            'options' => [
                'label' => ConstantesPedidos::TELEFONE_FIXO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::DESCRICAO_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::DESCRICAO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::ACABAMENTO_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::ACABAMENTO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::TUBOS_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::TUBOS_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::REVESTIMENTO_NAME,
            'type' => Select::class,
            'options' => [
                'label' => ConstantesPedidos::REVESTIMENTO_LABEL,
                'value_options' => [
                    true => 'Sim',
                    false => 'Não'
                ]
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::VALOR_TOTAL_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::VALOR_TOTAL_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::PRAZO_MONTAGEM_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::PRAZO_MONTAGEM_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::NUMERO_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::NUMERO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::BAIRRO_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::BAIRRO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CIDADE_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::CIDADE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CEP_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::CEP_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::REFERENCIA_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::REFERENCIA_LABEL,
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Gravar',
                'id'    => 'submitbutton',
            ],
        ]);
    }

    public function getInputFilterSpecification(): array
    {
        return [
            'numero' => [
                'required'    => false,
                'allow_empty' => true,
            ],
            'telefone' => [
                'required'    => false,
                'allow_empty' => true,
            ],
            'telefone_fixo' => [
                'required'    => false,
                'allow_empty' => true,
            ],
            'valor_total' => [
                'required'    => false,
                'allow_empty' => true,
            ],
            'cep' => [
                'required'    => false,
                'allow_empty' => true,
            ],
            'prazo_montagem' => [
                'required'    => false,
                'allow_empty' => true,
            ],
            'cpf' => [
                'required' => false,
                'validators' => [[
                    'name' => Callback::class,
                    'options' => [
                        'messages' => [
                            Callback::INVALID_VALUE =>
                                'CPF só pode ser preenchido se CNPJ e SS estiverem vazios.',
                        ],
                        'callback' => function ($value, $context = []) {
                            if (! empty($value)) {
                                return empty($context['cnpj'])
                                    && empty($context[ConstantesPedidos::SS_NAME]);
                            }
                            return true;
                        },
                    ],
                ]],
            ],
            'rg' => [
                'required' => false,
                'validators' => [[
                    'name' => Callback::class,
                    'options' => [
                        'messages' => [
                            Callback::INVALID_VALUE =>
                                'RG só pode ser preenchido se CNPJ e SS estiverem vazios.',
                        ],
                        'callback' => function ($value, $context = []) {
                            if (! empty($value)) {
                                return empty($context['cnpj'])
                                    && empty($context[ConstantesPedidos::SS_NAME]);
                            }
                            return true;
                        },
                    ],
                ]],
            ],
            'cnpj' => [
                'required' => false,
                'validators' => [[
                    'name' => Callback::class,
                    'options' => [
                        'messages' => [
                            Callback::INVALID_VALUE =>
                                'CNPJ só pode ser preenchido se CPF e RG estiverem vazios.',
                        ],
                        'callback' => function ($value, $context = []) {
                            if (! empty($value)) {
                                return empty($context['cpf'])
                                    && empty($context['rg']);
                            }
                            return true;
                        },
                    ],
                ]],
            ],
            ConstantesPedidos::SS_NAME => [
                'required' => false,
                'validators' => [[
                    'name' => Callback::class,
                    'options' => [
                        'messages' => [
                            Callback::INVALID_VALUE =>
                                'Serviço Social só pode ser preenchido se CPF e RG estiverem vazios.',
                        ],
                        'callback' => function ($value, $context = []) {
                            if (! empty($value)) {
                                return empty($context['cpf'])
                                    && empty($context['rg']);
                            }
                            return true;
                        },
                    ],
                ]],
            ],
        ];
    }
}

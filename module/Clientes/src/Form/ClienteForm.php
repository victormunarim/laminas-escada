<?php

declare(strict_types=1);

namespace Clientes\Form;

use Clientes\Constantes\ConstantesClientes;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Laminas\Validator\Callback;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\Hostname;
use Laminas\Validator\NotEmpty;

class ClienteForm extends Form implements InputFilterProviderInterface
{
    /**
     * @param string|null $name
     */
    public function __construct(?string $name = null)
    {
        parent::__construct(ConstantesClientes::ROUTE);

        $this->add([
            'name' => ConstantesClientes::CLIENTE_ID_NAME,
            'type' => Hidden::class,
        ]);

        $this->add([
            'name' => ConstantesClientes::CLIENTE_NOME_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesClientes::CLIENTE_NOME_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::EMAIL_NAME,
            'type' => Email::class,
            'options' => [
                'label' => ConstantesClientes::EMAIL_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::CPF_NAME,
            'type' => Text::class,
            'required' => false,
            'options' => [
                'label' => ConstantesClientes::CPF_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::RG_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesClientes::RG_LABEL,
            ],
        ]);
        $this->add([
            'name' => ConstantesClientes::CNPJ_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesClientes::CNPJ_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::SS_NAME,
            'type' => Text::class,
            'required' => false,
            'options' => [
                'label' => ConstantesClientes::SS_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::NUMERO_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesClientes::NUMERO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::BAIRRO_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesClientes::BAIRRO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::CIDADE_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesClientes::CIDADE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::CEP_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesClientes::CEP_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesClientes::REFERENCIA_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesClientes::REFERENCIA_LABEL,
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Gravar',
                'id' => 'submitbutton',
            ],
        ]);
    }

    public function getInputFilterSpecification(): array
    {
        return [
            'nome' => [
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                ],
                'validators' => [
                    [
                        'name' => NotEmpty::class,
                        'options' => [
                            'messages' => [
                                NotEmpty::IS_EMPTY => 'O nome do cliente é obrigatório',
                            ],
                        ],
                    ],
                ],
            ],

            'email' => [
                'required' => false,
                'allow_empty' => true,
                'validators' => [
                    [
                        'name' => EmailAddress::class,
                        'options' => [
                            'useMxCheck' => false,
                            'allow' => Hostname::ALLOW_DNS,
                            'messages' => [
                                EmailAddress::INVALID_FORMAT => 'E-mail inválido',
                            ],
                        ],
                    ],
                ],
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
                                    && empty($context[ConstantesClientes::SS_NAME]);
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
                                    && empty($context[ConstantesClientes::SS_NAME]);
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
            ConstantesClientes::SS_NAME => [
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

            'numero' => [
                'required'    => false,
                'allow_empty' => true,
            ],
            'cep' => [
                'required'    => false,
                'allow_empty' => true,
            ],
        ];
    }
}

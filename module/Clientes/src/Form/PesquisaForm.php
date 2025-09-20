<?php

declare(strict_types=1);

namespace Clientes\Form;

use Clientes\Constantes\ConstantesClientes;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Pedidos\Constantes\ConstantesPedidos;

class PesquisaForm extends Form
{
    /**
     * @param string|null $name
     */
    public function __construct(?string $name = null)
    {
        parent::__construct(ConstantesPedidos::ROUTE);

        $this->add([
            'name' => ConstantesClientes::CLIENTE_NOME_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesClientes::CLIENTE_NOME_LABEL,
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
                'value' => 'Pesquisar',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary'
            ],
        ]);

        $this->setAttribute('method', 'GET');
        $this->setAttribute('action', '/' . 'clientes');
    }
}
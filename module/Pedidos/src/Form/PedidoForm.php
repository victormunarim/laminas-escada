<?php

declare(strict_types=1);

namespace Pedidos\Form;

use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Date;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Tel;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Pedidos\Constantes\ConstantesPedidos;

class PedidoForm extends Form
{
    /**
     * @param string|null $name
     */
    public function __construct(?string $name = null)
    {
        parent::__construct(ConstantesPedidos::ROUTE);

//        $this->add([
//            'name' => ConstantesPedidos::ID_NAME,
//            'type' => Hidden::class,
//        ]);

        $this->add([
            'name' => ConstantesPedidos::ID_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::ID_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::NUMERO_PEDIDO_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::NUMERO_PEDIDO_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CLIENTE_ID_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::CLIENTE_ID_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::CPF_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::CPF_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::RG_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::RG_LABEL,
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
            'name' => ConstantesPedidos::CNPJ_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::CNPJ_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::EMAIL_NAME,
            'type' => Email::class,
            'options' => [
                'label' => ConstantesPedidos::EMAIL_LABEL,
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
            'name' => ConstantesPedidos::REVESTIMENTO_NAME,
            'type' => Checkbox::class,
            'options' => [
                'label' => ConstantesPedidos::REVESTIMENTO_LABEL,
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
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Gravar',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Pedidos\Form;

use Laminas\Form\Element\Date;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Submit;
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

        $this->add([
            'name' => ConstantesPedidos::ID_NAME,
            'type' => Hidden::class,
        ]);

        $this->add([
            'name' => ConstantesPedidos::NOME_NAME,
            'type' => Text::class,
            'options' => [
                'label' => ConstantesPedidos::NOME_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::IDADE_NAME,
            'type' => Number::class,
            'options' => [
                'label' => ConstantesPedidos::IDADE_LABEL,
            ],
        ]);

        $this->add([
            'name' => ConstantesPedidos::DATA_NAME,
            'type' => Date::class,
            'options' => [
                'label' => ConstantesPedidos::DATA_LABEL,
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

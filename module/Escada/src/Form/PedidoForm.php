<?php

namespace Escada\Form;

use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class PedidoForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Pedidos');

        $this->add([
            'name' => 'id',
            'type' => Hidden::class,
        ]);
        $this->add([
            'name' => 'nome',
            'type' => Text::class,
            'options' => [
                'label' => 'Nome',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}
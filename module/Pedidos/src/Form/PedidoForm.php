<?php

declare(strict_types=1);

namespace Pedidos\Form;

use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class PedidoForm extends Form
{
    /**
     * @param string|null $name
     */
    public function __construct(?string $name = null)
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
            'name' => 'idade',
            'type' => Number::class,
            'options' => [
                'label' => 'Idade',
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

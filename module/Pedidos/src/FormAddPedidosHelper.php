<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\FormAddHelperGenerico;
use Laminas\Form\Form;

class FormAddPedidosHelper extends FormAddHelperGenerico
{
    public function __invoke(Form $form, string $title, string $route): string
    {
        return parent::__invoke(
            $form,
            $title,
            $route
        );
    }
}

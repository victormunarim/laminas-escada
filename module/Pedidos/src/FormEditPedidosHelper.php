<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\FormEditHelperGenerico;
use Laminas\Form\Form;

class FormEditPedidosHelper extends FormEditHelperGenerico
{
    public function __invoke(Form $form, string $title, string $route, ?int $id = null): string
    {
        return parent::__invoke(
            $form,
            $title,
            $route,
            $id
        );
    }
}

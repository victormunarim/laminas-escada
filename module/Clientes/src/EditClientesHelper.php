<?php

declare(strict_types=1);

namespace Clientes;

use Application\View\Helper\FormEditHelperGenerico;
use Laminas\Form\Form;

class EditClientesHelper extends FormEditHelperGenerico
{
    protected function prepareForm(Form $form, string $route, ?int $id): void
    {
        $form->setAttribute('action', $this->getView()->url($route, [
            'action' => 'edit',
            'cliente_id' => $id,
        ]));

        $form->setAttribute('method', 'post');

        $form->prepare();
    }
}
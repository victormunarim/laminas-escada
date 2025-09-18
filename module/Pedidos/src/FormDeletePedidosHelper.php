<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\FormDeleteHelperGenerico;

class FormDeletePedidosHelper extends FormDeleteHelperGenerico
{
    public function __invoke(string $title, string $route, int $id, string $nomeCliente): string
    {
        return parent::__invoke(
            $title,
            $route,
            $id,
            $nomeCliente
        );
    }
}

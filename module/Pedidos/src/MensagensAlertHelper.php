<?php

declare(strict_types=1);

namespace Pedidos;

use Application\View\Helper\MensagensAlertHelperGenerica;

class MensagensAlertHelper extends MensagensAlertHelperGenerica
{

    protected function getMensagemWarning(string $url): string
    {
        return 'Nenhum pedido cadastrado. ' .
            '<a href="' . $url . '" class="alert-link">Cadastrar primeiro pedido</a>';
    }
}

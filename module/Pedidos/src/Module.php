<?php

declare(strict_types=1);

namespace Pedidos;

use Pedidos\Factory\Controller\PedidosControllerFactory;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\PedidosController::class => PedidosControllerFactory::class,
            ],
        ];
    }
}

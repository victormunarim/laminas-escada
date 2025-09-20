<?php

declare(strict_types=1);

namespace Clientes\Controller;

use Clientes\Constantes\ConstantesClientes;
use Clientes\Model\ClientesTable;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Clientes\Form\PesquisaForm;

class ClientesController extends AbstractActionController
{
    private ClientesTable $tableClientes;

    private PesquisaForm $pesquisaForm;

    public function __construct(
        ClientesTable $tableClientes,
        PesquisaForm $pesquisaForm
    ) {
        $this->tableClientes = $tableClientes;
        $this->pesquisaForm = $pesquisaForm;
    }

    public function indexAction()
    {
        $request = $this->getRequest();

        $campos = [
            ConstantesClientes::CLIENTE_NOME_NAME,
            ConstantesClientes::NUMERO_NAME,
            ConstantesClientes::BAIRRO_NAME,
            ConstantesClientes::CIDADE_NAME,
            ConstantesClientes::CEP_NAME,
            ConstantesClientes::REFERENCIA_NAME,
        ];

        $filters = [];
        if ($request->isGet()) {
            $filters = array_map(
                fn($campo) => $this->params()->fromQuery($campo),
                array_combine($campos, $campos)
            );
        }

        $clientes = $this->tableClientes->procuraClientesEEnderecos($filters);

        return (new ViewModel([
            'action'       => 'index',
            'pesquisaForm' => $this->pesquisaForm,
            'pedidos'      => $clientes,
            'filters'      => $filters,
            'searchTerm'   => $filters ?: null,
        ]))->setTemplate('clientes/index');
    }

    public function addAction(): ViewModel|Response
    {

    }

    public function editAction(): ViewModel|Response
    {

    }

    public function deleteAction(): ViewModel|Response
    {

    }
}

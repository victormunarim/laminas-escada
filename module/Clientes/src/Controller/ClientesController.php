<?php

declare(strict_types=1);

namespace Clientes\Controller;

use Clientes\Constantes\ConstantesClientes;
use Clientes\Form\ClienteForm;
use Clientes\Model\Clientes;
use Clientes\Model\ClientesTable;
use Laminas\Form\FormInterface;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Clientes\Form\PesquisaForm;

class ClientesController extends AbstractActionController
{
    private ClientesTable $tableClientes;

    private PesquisaForm $pesquisaForm;

    private ClienteForm $clienteForm;

    public function __construct(
        ClientesTable $tableClientes,
        PesquisaForm $pesquisaForm,
        ClienteForm $clienteForm
    ) {
        $this->tableClientes = $tableClientes;
        $this->pesquisaForm = $pesquisaForm;
        $this->clienteForm = $clienteForm;
    }

    public function indexAction()
    {
        $request = $this->getRequest();

        $campos = [
            ConstantesClientes::CLIENTE_NOME_NAME,
            ConstantesClientes::EMAIL_NAME,
            ConstantesClientes::CPF_NAME,
            ConstantesClientes::CNPJ_NAME,
            ConstantesClientes::RG_NAME,
            ConstantesClientes::SS_NAME,
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

        return (new ViewModel([
            'action'       => 'index',
            'pesquisaForm' => $this->pesquisaForm,
            'filters'      => $filters,
            'searchTerm'   => $filters ?: null,
        ]))->setTemplate('clientes/index');
    }

    public function addAction(): ViewModel|Response
    {
        $request = $this->getRequest();

        if (! $request->isPost()) {
            return (new ViewModel([
                'action' => 'add',
                'clienteForm'   => $this->clienteForm,
            ]))->setTemplate('clientes/index');
        }

        $this->clienteForm->setData($request->getPost());

        if (! $this->clienteForm->isValid()) {
            return (new ViewModel([
                'action' => 'add',
                'clienteForm'   => $this->clienteForm,
            ]))->setTemplate('clientes/index');
        }

        $cliente = new Clientes();
        $cliente->exchangeArray($this->clienteForm->getData());
        $this->tableClientes->saveCliente($cliente);

        return $this->redirect()->toRoute(ConstantesClientes::ROUTE);
    }

    public function editAction(): ViewModel|Response
    {
        $id = (int) $this->params()->fromRoute('cliente_id', 0);

        if ($id === 0) {
            return $this->redirect()->toRoute(ConstantesClientes::ROUTE, ['action' => 'index']);
        }

        $cliente = $this->tableClientes->getClientes($id);

        $request = $this->getRequest();

        if (! $request->isPost()) {
            $this->clienteForm->setData($cliente->getArrayCopy());
            $this->clienteForm->get('submit')->setAttribute('value', 'Salvar Alterações');

            return (new ViewModel([
                'action' => 'edit',
                'cliente_id' => $id,
                'clienteForm' => $this->clienteForm,
            ]))->setTemplate('clientes/index');
        }

        $this->clienteForm->setData($request->getPost());

        if (! $this->clienteForm->isValid()) {
            return (new ViewModel([
                'action' => 'edit',
                'cliente_id'  => $id,
                'clienteForm' => $this->clienteForm,
            ]))->setTemplate('clientes/index');
        }

        $data = $this->clienteForm->getData(FormInterface::VALUES_AS_ARRAY);
        $clienteAtualizado = new Clientes();
        $clienteAtualizado->exchangeArray($data);
        $clienteAtualizado->setId($id);

        $this->tableClientes->saveCliente($clienteAtualizado);

        return $this->redirect()->toRoute(ConstantesClientes::ROUTE, ['action' => 'index']);
    }

    public function deleteAction(): ViewModel|Response
    {
        $id = (int) $this->params()->fromRoute('cliente_id', 0);

        if ($id === 0) {
            return $this->redirect()->toRoute(ConstantesClientes::ROUTE);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $deleteStatus = (bool) $request->getPost('deleteStatus', false);

            if ($deleteStatus) {
                $cliente = $this->tableClientes->getClientes($id);
                $cliente->setFlagOculto(1);
                $this->tableClientes->saveCliente($cliente);
            }

            return $this->redirect()->toRoute(ConstantesClientes::ROUTE);
        }

        $cliente = $this->tableClientes->getClientes($id);

        return (new ViewModel([
            'action'      => 'delete',
            'cliente'      => $cliente,
        ]))->setTemplate('clientes/index');
    }
}

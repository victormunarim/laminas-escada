<?php

declare(strict_types=1);

namespace Pedidos\Controller;

use Pedidos\Form\PedidoForm;
use Pedidos\Model\Pedidos;
use Pedidos\Model\PedidosTable;
use Laminas\Http\PhpEnvironment\Request;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PedidosController extends AbstractActionController
{
    private PedidosTable $table;
    private PedidoForm $form;

    public function __construct(PedidosTable $table, PedidoForm $form)
    {
        $this->table = $table;
        $this->form  = $form;
    }

    /**
     * @return array<string, mixed>|ViewModel
     */
    public function indexAction(): array|ViewModel
    {
        /** @var Request $request */
        $request = $this->getRequest();
        $filters = [];

        if ($request->isGet()) {
            $filters['nome']  = $this->params()->fromQuery('nome');
            $filters['idade'] = $this->params()->fromQuery('idade');
        }

        $pedidos = $this->table->procuraPedidos($filters);

        return new ViewModel([
            'pedidos' => $pedidos,
            'filters' => $filters,
        ]);
    }

    /**
     * @return array<string, mixed>|ViewModel|\Laminas\Http\Response
     */
    public function addAction(): array|ViewModel|\Laminas\Http\Response
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if (! $request->isPost()) {
            return new ViewModel(['form' => $this->form]);
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return new ViewModel(['form' => $this->form]);
        }

        $validatedData = $this->form->getData();

        $pedido = new Pedidos();
        $pedido->exchangeArray($validatedData);

        $this->table->savePedido($pedido);

        return $this->redirect()->toRoute('Pedidos');
    }

    /**
     * @return array<string, mixed>|\Laminas\Http\Response
     */
    public function editAction(): array|\Laminas\Http\Response
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id === 0) {
            return $this->redirect()->toRoute('Pedidos', ['action' => 'add']);
        }

        try {
            $pedido = $this->table->getPedidos($id);
        } catch (\Exception) {
            return $this->redirect()->toRoute('Pedidos', ['action' => 'index']);
        }

        /** @var Request $request */
        $request = $this->getRequest();

        if (! $request->isPost()) {
            $this->form->bind($pedido);
            $this->form->get('submit')->setAttribute('value', 'Salvar Alterações');

            return ['id' => $id, 'form' => $this->form];
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return ['id' => $id, 'form' => $this->form];
        }

        try {
            $validatedData       = $this->form->getData();
            $validatedData['id'] = $id;

            $pedidoAtualizado = new Pedidos();
            $pedidoAtualizado->exchangeArray($validatedData);

            $this->table->savePedido($pedidoAtualizado);
        } catch (\Exception $e) {
            error_log('Erro ao atualizar pedido: ' . $e->getMessage());
        }

        return $this->redirect()->toRoute('Pedidos', ['action' => 'index']);
    }

    /**
     * @return array<string, mixed>|\Laminas\Http\Response
     */
    public function deleteAction(): array|\Laminas\Http\Response
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id === 0) {
            return $this->redirect()->toRoute('Pedidos');
        }

        try {
            $pedido = $this->table->getPedidos($id);
        } catch (\Exception) {
            return $this->redirect()->toRoute('Pedidos', ['action' => 'index']);
        }

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del === 'Yes') {
                try {
                    $this->table->deletePedido($id);
                } catch (\Exception) {
                }
            }

            return $this->redirect()->toRoute('Pedidos');
        }

        return [
            'id'     => $id,
            'pedido' => $pedido,
        ];
    }
}

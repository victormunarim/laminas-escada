<?php

namespace Escada\Controller;

use Escada\Form\PedidoForm;
use Escada\Model\Pedidos;
use Escada\Model\PedidosTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PedidosController extends AbstractActionController
{
    private PedidosTable $table;
    private ?PedidoForm $form;

    public function __construct(PedidosTable $table, PedidoForm $form)
    {
        $this->table = $table;
        $this->form = $form;
    }

    public function indexAction()
    {
        return new ViewModel([
            'pedidos' => $this->table->fetchAll()
        ]);
    }

    public function addAction()
    {
        $request = $this->getRequest();

        if (! $request->isPost()) {
            return new ViewModel(['form' => $this->form]);
        }

        $postData = $request->getPost();
        $this->form->setData($postData);

        if (! $this->form->isValid()) {
            // O formulário já contém as mensagens de erro automaticamente
            return new ViewModel(['form' => $this->form]);
        }

        // Os dados já estão validados pelo InputFilter
        $validatedData = $this->form->getData();

        $pedido = new Pedidos();
        $pedido->exchangeArray($validatedData);

        $this->table->savePedido($pedido);

        return $this->redirect()->toRoute('escada');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('escada', ['action' => 'add']);
        }

        try {
            $pedido = $this->table->getPedidos($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('escada', ['action' => 'index']);
        }

        $request = $this->getRequest();

        if (! $request->isPost()) {
            // Preenche o formulário com dados existentes
            $this->form->bind($pedido);
            $this->form->get('submit')->setAttribute('value', 'Salvar Alterações');
            return ['id' => $id, 'form' => $this->form];
        }

        $postData = $request->getPost();
        $this->form->setData($postData);

        if (! $this->form->isValid()) {
            return ['id' => $id, 'form' => $this->form];
        }

        try {
            // Usa os dados validados pelo InputFilter
            $validatedData = $this->form->getData();
            $validatedData['id'] = $id; // Garante o ID

            $pedidoAtualizado = new Pedidos();
            $pedidoAtualizado->exchangeArray($validatedData);

            $this->table->savePedido($pedidoAtualizado);
        } catch (\Exception $e) {
            error_log('Erro ao atualizar pedido: ' . $e->getMessage());
        }

        return $this->redirect()->toRoute('escada', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (! $id) {
            return $this->redirect()->toRoute('escada');
        }

        try {
            $pedido = $this->table->getPedidos($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('escada', ['action' => 'index']);
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                try {
                    $this->table->deletePedido($id);
                } catch (\Exception $e) {
                }
            }

            return $this->redirect()->toRoute('escada');
        }

        return [
            'id' => $id,
            'pedido' => $pedido,
        ];
    }
}
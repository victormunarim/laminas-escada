<?php

declare(strict_types=1);

namespace Pedidos\Controller;

use Laminas\Http\Response;
use Laminas\Hydrator\ClassMethodsHydrator;
use Pedidos\Constantes\ConstantesPedidos;
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

    public function indexAction(): ViewModel
    {
        /** @var Request $request */
        $request = $this->getRequest();
        $filters = [];

        if ($request->isGet()) {
            $filters[ConstantesPedidos::ID_NAME] = $this->params()->fromQuery(ConstantesPedidos::ID_NAME);
            $filters[
                ConstantesPedidos::NUMERO_PEDIDO_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::NUMERO_PEDIDO_NAME);
            $filters[
                ConstantesPedidos::CLIENTE_ID_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::CLIENTE_ID_NAME);
            $filters[ConstantesPedidos::CPF_NAME] = $this->params()->fromQuery(ConstantesPedidos::CPF_NAME);
            $filters[ConstantesPedidos::RG_NAME] = $this->params()->fromQuery(ConstantesPedidos::RG_NAME);
            $filters[
                ConstantesPedidos::PROFISSAO_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::PROFISSAO_NAME);
            $filters[ConstantesPedidos::CNPJ_NAME] = $this->params()->fromQuery(ConstantesPedidos::CNPJ_NAME);
            $filters[ConstantesPedidos::EMAIL_NAME] = $this->params()->fromQuery(ConstantesPedidos::EMAIL_NAME);
            $filters[
                ConstantesPedidos::ADM_OBRA_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::ADM_OBRA_NAME);
            $filters[
                ConstantesPedidos::TELEFONE_NAME] = $this->params()->fromQuery(ConstantesPedidos::TELEFONE_NAME);
            $filters[
                ConstantesPedidos::TELEFONE_FIXO_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::TELEFONE_FIXO_NAME);
            $filters[
                ConstantesPedidos::DESCRICAO_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::DESCRICAO_NAME);
            $filters[
                ConstantesPedidos::REVESTIMENTO_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::REVESTIMENTO_NAME);
            $filters[
                ConstantesPedidos::VALOR_TOTAL_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::VALOR_TOTAL_NAME);
            $filters[
                ConstantesPedidos::PRAZO_MONTAGEM_NAME
            ] = $this->params()->fromQuery(ConstantesPedidos::PRAZO_MONTAGEM_NAME);
        }

        $pedidos = $this->table->procuraPedidos($filters);

        return (new ViewModel([
            'action'     => 'index',
            'pedidos'    => $pedidos,
            'filters'    => $filters,
            'searchTerm' => $filters[ConstantesPedidos::ID_NAME] ?? null,
        ]))->setTemplate('pedidos/index');
    }

    public function addAction(): ViewModel|Response
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if (! $request->isPost()) {
            return (new ViewModel([
                'action' => 'add',
                'form'   => $this->form,
            ]))->setTemplate('pedidos/index');
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return (new ViewModel([
                'action' => 'add',
                'form'   => $this->form,
            ]))->setTemplate('pedidos/index');
        }

        $pedido = new Pedidos();
        $pedido->exchangeArray($this->form->getData());
        $this->table->savePedido($pedido);

        return $this->redirect()->toRoute(ConstantesPedidos::ROUTE);
    }

    public function editAction(): ViewModel|Response
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute(ConstantesPedidos::ROUTE, ['action' => 'add']);
        }

        try {
            $pedido = $this->table->getPedidos($id);
        } catch (\Exception) {
            return $this->redirect()->toRoute(ConstantesPedidos::ROUTE, ['action' => 'index']);
        }

        /** @var Request $request */
        $request = $this->getRequest();

        if (! $request->isPost()) {
            if (! $this->form->getHydrator()) {
                $this->form->setHydrator(new ClassMethodsHydrator());
            }

            $this->form->bind($pedido);
            $this->form->get('submit')->setAttribute('value', 'Salvar Alterações');

            $dataValue = null;
            if (method_exists($pedido, 'getData')) {
                $dataValue = $pedido->getData();
            } elseif (property_exists($pedido, 'data')) {
                $raw = $pedido->getData();
                if ($raw instanceof \DateTimeInterface) {
                    $dataValue = $raw->format('Y-m-d');
                } elseif (is_string($raw)) {
                    $dt = \DateTime::createFromFormat('Y-m-d', $raw)
                        ?: \DateTime::createFromFormat('d/m/Y', $raw);
                    $dataValue = $dt ? $dt->format('Y-m-d') : $raw;
                }
            }

            if ($dataValue !== null && $this->form->has('data')) {
                $this->form->get('data')->setValue($dataValue);
            }

            error_log(
                'DEBUG editAction: pedido->getData() = ' . var_export(
                    method_exists($pedido, 'getData') ? $pedido->getData() : null,
                    true
                )
            );
            if ($this->form->has('data')) {
                error_log(
                    'DEBUG editAction: form->get(data)->getValue() = ' . var_export(
                        $this->form->get('data')->getValue(),
                        true
                    )
                );
            }

            return (new ViewModel([
                'action' => 'edit',
                'id'     => $id,
                'form'   => $this->form,
            ]))->setTemplate('pedidos/index');
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return (new ViewModel([
                'action' => 'edit',
                'id'     => $id,
                'form'   => $this->form,
            ]))->setTemplate('pedidos/index');
        }

        try {
            $validatedData = $this->form->getData();
            $validatedData['id'] = $id;

            $pedidoAtualizado = new Pedidos();
            $pedidoAtualizado->exchangeArray($validatedData);

            $this->table->savePedido($pedidoAtualizado);
        } catch (\Exception $e) {
            error_log('Erro ao atualizar pedido: ' . $e->getMessage());
        }

        return $this->redirect()->toRoute(ConstantesPedidos::ROUTE, ['action' => 'index']);
    }


    public function deleteAction(): ViewModel|Response
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id === 0) {
            return $this->redirect()->toRoute(ConstantesPedidos::ROUTE);
        }

        try {
            $pedido = $this->table->getPedidos($id);
        } catch (\Exception) {
            return $this->redirect()->toRoute(ConstantesPedidos::ROUTE, ['action' => 'index']);
        }

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del === 'Yes') {
                $this->table->deletePedido($id);
            }

            return $this->redirect()->toRoute(ConstantesPedidos::ROUTE);
        }

        return (new ViewModel([
            'action' => 'delete',
            'id'     => $id,
            'pedido' => $pedido,
        ]))->setTemplate('pedidos/index');
    }
}

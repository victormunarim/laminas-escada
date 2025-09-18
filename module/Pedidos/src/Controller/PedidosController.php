<?php

declare(strict_types=1);

namespace Pedidos\Controller;

use Laminas\Form\FormInterface;
use Laminas\Http\Response;
use Pedidos\Constantes\ConstantesPedidos;
use Pedidos\Form\PedidoForm;
use Pedidos\Form\PesquisaForm;
use Pedidos\Model\ClientesTable;
use Pedidos\Model\Pedidos;
use Pedidos\Model\PedidosTable;
use Laminas\Http\PhpEnvironment\Request;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PedidosController extends AbstractActionController
{
    private PedidosTable $table;
    private ClientesTable $tableClientes;
    private PedidoForm $form;
    private PesquisaForm $pesquisaForm;

    public function __construct(
        PedidosTable $table,
        PedidoForm $form,
        PesquisaForm $pesquisaForm,
        ClientesTable $tableClientes
    ) {
        $this->table = $table;
        $this->form = $form;
        $this->pesquisaForm = $pesquisaForm;
        $this->tableClientes = $tableClientes;
    }

    public function indexAction(): ViewModel
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $campos = [
            ConstantesPedidos::ID_NAME,
            ConstantesPedidos::NUMERO_PEDIDO_NAME,
            ConstantesPedidos::CLIENTE_ID_NAME,
            ConstantesPedidos::CPF_NAME,
            ConstantesPedidos::RG_NAME,
            ConstantesPedidos::PROFISSAO_NAME,
            ConstantesPedidos::CNPJ_NAME,
            ConstantesPedidos::EMAIL_NAME,
            ConstantesPedidos::ADM_OBRA_NAME,
            ConstantesPedidos::TELEFONE_NAME,
            ConstantesPedidos::TELEFONE_FIXO_NAME,
            ConstantesPedidos::DESCRICAO_NAME,
            ConstantesPedidos::ACABAMENTO_NAME,
            ConstantesPedidos::TUBOS_NAME,
            ConstantesPedidos::REVESTIMENTO_NAME,
            ConstantesPedidos::VALOR_TOTAL_NAME,
            ConstantesPedidos::PRAZO_MONTAGEM_NAME,
        ];

        $filters = [];
        if ($request->isGet()) {
            $filters = array_map(
                fn($campo) => $this->params()->fromQuery($campo),
                array_combine($campos, $campos)
            );
        }

        $pedidos = $this->table->procuraPedidos($filters);

        return (new ViewModel([
            'action'       => 'index',
            'pedidos'      => $pedidos,
            'filters'      => $filters,
            'searchTerm'   => $filters ?: null,
            'pesquisaForm' => $this->pesquisaForm,
        ]))->setTemplate('pedidos/index');
    }

    public function addAction(): ViewModel|Response
    {
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
        $id = (int) $this->params()->fromRoute('id_pedido', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute(ConstantesPedidos::ROUTE, ['action' => 'index']);
        }

        try {
            $pedido = $this->table->getPedidos($id);
        } catch (\Exception) {
            return $this->redirect()->toRoute(ConstantesPedidos::ROUTE, ['action' => 'index']);
        }

        $request = $this->getRequest();

        if (! $request->isPost()) {
            $this->form->setData($pedido->getArrayCopy());
            $this->form->get('submit')->setAttribute('value', 'Salvar Alterações');

            return (new ViewModel([
                'action'     => 'edit',
                'id_pedido'  => $id,
                'form'       => $this->form,
            ]))->setTemplate('pedidos/index');
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return (new ViewModel([
                'action'     => 'edit',
                'id_pedido'  => $id,
                'form'       => $this->form,
            ]))->setTemplate('pedidos/index');
        }

        $data = $this->form->getData(FormInterface::VALUES_AS_ARRAY);
        $pedidoAtualizado = new Pedidos();
        $pedidoAtualizado->exchangeArray($data);
        $pedidoAtualizado->setId($id);
        $this->table->savePedido($pedidoAtualizado);

        return $this->redirect()->toRoute(ConstantesPedidos::ROUTE, ['action' => 'index']);
    }

    public function deleteAction(): ViewModel|Response
    {
        $id = (int) $this->params()->fromRoute('id_pedido', 0);

        if ($id === 0) {
            return $this->redirect()->toRoute(ConstantesPedidos::ROUTE);
        }

        $pedido = $this->table->getPedidos($id);
        $pedido->setFlagOculto(1);
        $this->table->savePedido($pedido);

        $nomeCliente = $this->tableClientes->getClientes($pedido->getClienteId())->getNome();

        return (new ViewModel([
            'action'      => 'delete',
            'pedido'      => $pedido,
            'nomeCliente' => $nomeCliente,
        ]))->setTemplate('pedidos/index');
    }
}

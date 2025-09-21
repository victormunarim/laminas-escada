<?php

declare(strict_types=1);

namespace Clientes;

use Application\View\Helper\TabelaHelperGenerica;
use Clientes\Constantes\ConstantesClientes;
use Clientes\Model\Clientes;
use Clientes\Model\ClientesTable;
use Laminas\Db\ResultSet\ResultSetInterface;

class TabelaClientesHelper extends TabelaHelperGenerica
{
    private ClientesTable $clientesTable;

    public function __construct(ClientesTable $clientesTable)
    {
        $this->clientesTable = $clientesTable;
    }

    protected function pegaRoute(): string
    {
        return ConstantesClientes::ROUTE;
    }

    protected function pegaDados($filtros): ResultSetInterface
    {
        return $this->clientesTable->procuraClientes($filtros);
    }

    protected function getColunasFixas(): array
    {
        return [];
    }

    protected function getColunasIgnorar(): array
    {
        return [ConstantesClientes::CLIENTE_ID_VALUE, ConstantesClientes::FLAG_OCULTO_VALUE];
    }

    protected function getMapaNomesColunas(): array
    {
        return [
            ConstantesClientes::CLIENTE_ID_VALUE => ConstantesClientes::CLIENTE_ID_LABEL,
            ConstantesClientes::CLIENTE_NOME_VALUE => ConstantesClientes::CLIENTE_NOME_LABEL,
            ConstantesClientes::EMAIL_VALUE => ConstantesClientes::EMAIL_LABEL,
            ConstantesClientes::CPF_VALUE => ConstantesClientes::CPF_LABEL,
            ConstantesClientes::RG_VALUE => ConstantesClientes::RG_LABEL,
            ConstantesClientes::CNPJ_VALUE => ConstantesClientes::CNPJ_LABEL,
            ConstantesClientes::SS_VALUE => ConstantesClientes::SS_LABEL,
            ConstantesClientes::NUMERO_VALUE => ConstantesClientes::NUMERO_LABEL,
            ConstantesClientes::BAIRRO_VALUE => ConstantesClientes::BAIRRO_LABEL,
            ConstantesClientes::CIDADE_VALUE => ConstantesClientes::CIDADE_LABEL,
            ConstantesClientes::CEP_VALUE => ConstantesClientes::CEP_LABEL,
            ConstantesClientes::REFERENCIA_VALUE => ConstantesClientes::REFERENCIA_LABEL,
        ];
    }

    protected function renderizarAcoes(object|array $linha): string
    {
        $id = null;

        if ($linha instanceof Clientes) {
            $id = $linha->getId();
        } elseif (is_array($linha)) {
            $id = $linha['id'] ?? null;
        }

        if (empty($id)) {
            return '';
        }

        $id = $this->getView()->escapeHtml((string) $id);

        $editUrl = $this->getView()->url('clientes', [
            'action' => 'edit',
            'cliente_id' => $id,
        ]);

        $deleteUrl = $this->getView()->url('clientes', [
            'action' => 'delete',
            'cliente_id' => $id,
        ]);

        return '<div class="btn-group">'
            . '<a href="' . $editUrl . '" class="btn btn-primary">Editar</a>'
            . '<a href="' . $deleteUrl . '" class="btn btn-danger">Excluir</a>'
            . '</div>';
    }
}

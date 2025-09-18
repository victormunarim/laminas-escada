<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Application\DataHelper;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\View\Helper\AbstractHelper;
use Pedidos\Constantes\ConstantesPedidos;
use Pedidos\Model\Pedidos;
use Pedidos\Model\PedidosTable;

abstract class TabelaHelperGenerica extends AbstractHelper
{
    public function __construct(
        private PedidosTable $pedidosTable
    ) {
    }

    public function __invoke($filtros): string
    {
        $dados = $this->pedidosTable->procuraPedidos($filtros);

        if ($dados instanceof ResultSet) {
            $dados = iterator_to_array($dados);
        }

        if (count($dados) === 0) {
            return '';
        }

        $primeiro = $dados[0];
        $colunas = $this->getColunasDisponiveis($primeiro);

        $url = $this->getView()->url(ConstantesPedidos::ROUTE, ['action' => 'add']);

        $html  = '<div class="d-flex justify-content-start mt-5">';
        $html .= '<a href="' . $url . '" class="btn btn-success">';
        $html .= '<i class="bi bi-plus-lg"></i> Novo Pedido';
        $html .= '</a></div>';

        $html .= '<div class="table-responsive">';
        $html .= '<table class="table table-striped table-hover">';
        $html .= '<thead class="thead-dark"><tr>';

        foreach ($colunas as $coluna) {
            $html .= '<th>' . $this->formatarNomeColuna($coluna) . '</th>';
        }

        $html .= '<th>Ações</th></tr></thead><tbody>';

        foreach ($dados as $linha) {
            $html .= '<tr>';
            foreach ($colunas as $coluna) {
                $valor = $this->getValorColuna($linha, $coluna);
                if ($coluna === ConstantesPedidos::CLIENTE_ID_VALUE) {
                    $valor = $this->pedidosTable->getNomeClientePorId(1);
                }

                if ($coluna === 'revestimento') {
                    $valor = (int)$valor === 1 ? 'Sim' : 'Não';
                }
                $html .= '<td>' . $this->getView()->escapeHtml((string) $valor) . '</td>';
            }
            $html .= '<td>' . $this->renderAcoes($linha) . '</td></tr>';
        }

        $html .= '</tbody></table></div>';

        return $html;
    }

    /**
     * @param object|array<string, mixed> $linha
     * @return array<int, string>
     */
    private function getColunasDisponiveis(Pedidos $linha): array
    {
        $colunasFixas = $this->getColunasFixas();

        $reflection = new \ReflectionClass($linha);
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PRIVATE) as $property) {
            $colunasFixas[] = $property->getName();
        }

        $colunasIgnorar = $this->getColunasIgnorar();
        $colunasFixas   = array_diff($colunasFixas, $colunasIgnorar);

        return array_values(array_unique($colunasFixas));
    }

    private function formatarNomeColuna(string $coluna): string
    {
        $mapaNomes = $this->getMapaNomesColunas();
        return $mapaNomes[$coluna] ?? ucfirst($coluna);
    }

    /**
     * @param object|array<string, mixed> $linha
     * @return mixed
     */
    private function getValorColuna(Pedidos $linha, string $coluna): mixed
    {
        $getter = 'get' . ucfirst($coluna);

        if (method_exists($linha, $getter)) {
            return $linha->$getter();
        }

        return null;
    }

    /**
     * @param object|array<string, mixed> $linha
     */
    /**
     * @param object|array<string,mixed> $linha
     */
    private function renderAcoes(object|array $linha): string
    {
        return $this->renderizarAcoes($linha);
    }


    /**
     * @return array<int, string>
     */
    abstract protected function getColunasFixas(): array;

    /**
     * @return array<int, string>
     */
    abstract protected function getColunasIgnorar(): array;

    /**
     * @return array<string, string>
     */
    abstract protected function getMapaNomesColunas(): array;


    /**
     * @param \Pedidos\Model\Pedidos|array<string,mixed> $linha
     */
    abstract protected function renderizarAcoes(Pedidos|array $linha): string;


}

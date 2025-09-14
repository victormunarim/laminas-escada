<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\View\Helper\AbstractHelper;

abstract class TabelaHelperGenerica extends AbstractHelper
{
    /**
     * @param ResultSet|array<int, object|array<string, mixed>> $dados
     */
    public function __invoke(ResultSet|array $dados): string
    {
        if ($dados instanceof ResultSet) {
            $dados = iterator_to_array($dados);
        }

        if (count($dados) === 0) {
            return '';
        }

        $primeiro = $dados[0];
        $colunas = $this->getColunasDisponiveis($primeiro);

        $html = '<div class="table-responsive">';
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
    private function getColunasDisponiveis(object|array $linha): array
    {
        $colunasFixas = $this->getColunasFixas();

        if (is_object($linha)) {
            $reflection = new \ReflectionClass($linha);
            foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
                if (!in_array($property->getName(), $colunasFixas, true)) {
                    $colunasFixas[] = $property->getName();
                }
            }
        } elseif (is_array($linha)) {
            $colunasFixas = array_merge($colunasFixas, array_keys($linha));
        }

        $colunasIgnorar = $this->getColunasIgnorar();
        $colunasFixas = array_diff($colunasFixas, $colunasIgnorar);

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
    private function getValorColuna(object|array $linha, string $coluna): mixed
    {
        if (is_object($linha)) {
            $getter = 'get' . ucfirst($coluna);
            if (method_exists($linha, $getter)) {
                return $linha->$getter();
            }

            if (property_exists($linha, $coluna)) {
                return $linha->$coluna;
            }

            if ($linha instanceof \ArrayAccess && isset($linha[$coluna])) {
                return $linha[$coluna];
            }
        } elseif (is_array($linha) && isset($linha[$coluna])) {
            return $linha[$coluna];
        }

        return null;
    }

    /**
     * @param object|array<string, mixed> $linha
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
     * @param object|array<string, mixed> $linha
     */
    abstract protected function renderizarAcoes(object|array $linha): string;
}

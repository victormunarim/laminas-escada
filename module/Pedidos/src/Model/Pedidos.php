<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Pedidos\Constantes\ConstantesPedidos;

class Pedidos extends \ArrayObject implements InputFilterAwareInterface
{
    private ?int $id = null;
    private ?string $nome = null;
    private ?int $idade = null;
    private ?string $data = null;
    private ?InputFilterInterface $inputFilter = null;

    /**
     * @param array<string, mixed> $array
     */
    public function exchangeArray(array|object $array): array
    {
        $this->setId(! empty($array[ConstantesPedidos::ID_NAME]) ? (int) $array[ConstantesPedidos::ID_NAME] : null);
        $this->setNome(
            ! empty($array[ConstantesPedidos::NOME_NAME])
                ? (string) $array[ConstantesPedidos::NOME_NAME]
                : null
        );
        $this->setIdade(
            ! empty($array[ConstantesPedidos::IDADE_NAME])
                ? (int) $array[ConstantesPedidos::IDADE_NAME]
                : null
        );
        $this->setData(
            ! empty($array[ConstantesPedidos::DATA_NAME])
                ? (string) $array[ConstantesPedidos::DATA_NAME]
                : null
        );
        return parent::exchangeArray($array);
    }

    /**
     * @return array<string, int|string|null>
     */
    public function getArrayCopy(): array
    {
        return [
            ConstantesPedidos::ID_NAME => $this->id,
            ConstantesPedidos::NOME_NAME => $this->nome,
            ConstantesPedidos::IDADE_NAME => $this->idade,
            ConstantesPedidos::DATA_NAME => $this->idade,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): void
    {
        $this->nome = $nome;
    }

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(?int $idade): void
    {
        $this->idade = $idade;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(?string $data): void
    {
        $this->data = $data;
    }

    public function setInputFilter(InputFilterInterface $inputFilter): void
    {
        $this->inputFilter = $inputFilter;
    }

    public function getInputFilter(): ?InputFilterInterface
    {
        return $this->inputFilter;
    }
}

<?php

declare(strict_types=1);

namespace Escada\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class Pedidos extends \ArrayObject implements InputFilterAwareInterface
{
    private ?int $id = null;
    private ?string $nome = null;
    private ?int $idade = null;
    private ?InputFilterInterface $inputFilter = null;

    /**
     * @param array<string, mixed> $array
     */
    public function exchangeArray(array|object $array): array
    {
        $this->setId(! empty($array['id']) ? (int) $array['id'] : null);
        $this->setNome(! empty($array['nome']) ? (string) $array['nome'] : null);
        $this->setIdade(! empty($array['idade']) ? (int) $array['idade'] : null);
        return parent::exchangeArray($array);
    }

    /**
     * @return array<string, int|string|null>
     */
    public function getArrayCopy(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'idade' => $this->idade,
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

    public function setInputFilter(InputFilterInterface $inputFilter): void
    {
        $this->inputFilter = $inputFilter;
    }

    public function getInputFilter(): ?InputFilterInterface
    {
        return $this->inputFilter;
    }
}

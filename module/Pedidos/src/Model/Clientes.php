<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class Clientes extends \ArrayObject implements InputFilterAwareInterface
{
    private ?int $id = null;

    private ?string $nome = null;

    public function getArrayCopy(): array
    {
        return [
            'cliente_id' => $this->id,
            'nome' => $this->nome
        ];
    }

    public function exchangeArray(array|object $array): array
    {
        $this->setId(! empty($array['cliente_id']) ? (int)$array['cliente_id'] : null);

        $this->setNome(
            ! empty($array['nome'])
                ? (string) $array['nome']
                : null
        );
        return parent::exchangeArray($array);
    }

    private function setNome(?string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        // TODO: Implement setInputFilter() method.
    }

    public function getInputFilter()
    {
        // TODO: Implement getInputFilter() method.
    }

    public function __serialize(): array
    {
        // TODO: Implement __serialize() method.
    }

    public function __unserialize(array $data): void
    {
        // TODO: Implement __unserialize() method.
    }
}

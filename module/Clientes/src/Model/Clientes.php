<?php

declare(strict_types=1);

namespace Clientes\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class Clientes extends \ArrayObject implements InputFilterAwareInterface
{
    private ?int $id = null;

    private ?string $nome = null;


    private ?string $numero = null;


    private ?string $bairro = null;


    private ?string $cidade = null;


    private ?string $cep = null;


    private ?string $referencia = null;


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

        $this->setNumero(
            ! empty($array['numero'])
                ? (string) $array['numero']
                : null
        );

        $this->setBairro(
            ! empty($array['bairro'])
                ? (string) $array['bairro']
                : null
        );

        $this->setCidade(
            ! empty($array['cidade'])
                ? (string) $array['cidade']
                : null
        );

        $this->setCep(
            ! empty($array['cep'])
                ? (string) $array['cep']
                : null
        );

        $this->setReferencia(
            ! empty($array['referencia'])
                ? (string) $array['referencia']
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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;
        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): self
    {
        $this->bairro = $bairro;
        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): self
    {
        $this->cidade = $cidade;
        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): self
    {
        $this->cep = $cep;
        return $this;
    }

    public function getReferencia(): ?string
    {
        return $this->referencia;
    }

    public function setReferencia(?string $referencia): self
    {
        $this->referencia = $referencia;
        return $this;
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

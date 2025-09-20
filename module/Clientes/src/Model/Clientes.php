<?php

declare(strict_types=1);

namespace Clientes\Model;

use Clientes\Constantes\ConstantesClientes;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class Clientes extends \ArrayObject implements InputFilterAwareInterface
{
    private ?int $id = null;

    private ?string $nome = null;

    private ?int $cpf = null;

    private ?int $rg = null;

    private ?string $cnpj = null;

    private ?int $ss = null;

    private ?string $numero = null;


    private ?string $bairro = null;


    private ?string $cidade = null;


    private ?string $cep = null;


    private ?string $referencia = null;


    public function getArrayCopy(): array
    {
        return [
            ConstantesClientes::CLIENTE_ID_NAME => $this->id,
            ConstantesClientes::CLIENTE_NOME_NAME => $this->nome,
            ConstantesClientes::CPF_NAME => $this->nome,
            ConstantesClientes::CNPJ_NAME => $this->nome,
            ConstantesClientes::RG_NAME => $this->nome,
            ConstantesClientes::SS_NAME => $this->nome,
        ];
    }

    public function exchangeArray(array|object $array): array
    {
        $this->id = ! empty($array['cliente_id']) ? (int)$array['cliente_id'] : null;

        $this->nome = ! empty($array['nome'])
                ? (string) $array['nome']
                : null;

        $this->cpf = ! empty($array[ConstantesClientes::CPF_NAME])
            ? (int) $array[ConstantesClientes::CPF_NAME]
            : null;

        $this->rg = ! empty($array[ConstantesClientes::RG_NAME])
            ? (int) $array[ConstantesClientes::RG_NAME]
            : null;

        $this->cnpj = ! empty($array[ConstantesClientes::CNPJ_NAME])
            ? (string) $array[ConstantesClientes::CNPJ_NAME]
            : null;

        $this->ss = ! empty($array[ConstantesClientes::SS_NAME])
            ? (int) $array[ConstantesClientes::SS_NAME]
            : null;

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

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpf(): ?int
    {
        return $this->cpf;
    }

    public function setCpf(?int $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getRg(): ?int
    {
        return $this->rg;
    }

    public function setRg(?int $rg): void
    {
        $this->rg = $rg;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): void
    {
        $this->cnpj = $cnpj;
    }

    public function getSS(): ?int
    {
        return $this->ss;
    }

    public function setSS(?int $ss): void
    {
        $this->ss = $ss;
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

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

    private ?string $email = null;

    private ?string $cpf = null;

    private ?string $rg = null;

    private ?string $cnpj = null;

    private ?string $ss = null;

    private ?int $numero = null;


    private ?string $bairro = null;


    private ?string $cidade = null;


    private ?string $cep = null;


    private ?string $referencia = null;

    private ?int $flagOculto = null;


    public function getArrayCopy(): array
    {
        return [
            ConstantesClientes::CLIENTE_ID_NAME => $this->id,
            ConstantesClientes::CLIENTE_NOME_NAME => $this->nome,
            ConstantesClientes::EMAIL_NAME => $this->email,
            ConstantesClientes::CPF_NAME => $this->cpf,
            ConstantesClientes::CNPJ_NAME => $this->cnpj,
            ConstantesClientes::RG_NAME => $this->rg,
            ConstantesClientes::SS_NAME => $this->ss,
            ConstantesClientes::NUMERO_NAME => $this->numero,
            ConstantesClientes::CIDADE_NAME => $this->cidade,
            ConstantesClientes::BAIRRO_NAME => $this->bairro,
            ConstantesClientes::CEP_NAME => $this->cep,
            ConstantesClientes::REFERENCIA_NAME => $this->referencia,
        ];
    }

    public function exchangeArray(array|object $array): array
    {
        $this->id = ! empty($array['cliente_id']) ? (int)$array['cliente_id'] : null;

        $this->nome = ! empty($array['nome'])
                ? (string) $array['nome']
                : null;

        $this->cpf = ! empty($array[ConstantesClientes::CPF_NAME])
            ? (string) $array[ConstantesClientes::CPF_NAME]
            : null;

        $this->email = ! empty($array[ConstantesClientes::EMAIL_NAME])
            ? (string) $array[ConstantesClientes::EMAIL_NAME]
            : null;

        $this->rg = ! empty($array[ConstantesClientes::RG_NAME])
            ? (string) $array[ConstantesClientes::RG_NAME]
            : null;

        $this->cnpj = ! empty($array[ConstantesClientes::CNPJ_NAME])
            ? (string) $array[ConstantesClientes::CNPJ_NAME]
            : null;

        $this->ss = ! empty($array[ConstantesClientes::SS_NAME])
            ? (string) $array[ConstantesClientes::SS_NAME]
            : null;

        $this->setNumero(
            ! empty($array['numero'])
                ? (int) $array['numero']
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

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getRg(): ?string
    {
        return $this->rg;
    }

    public function setRg(?string $rg): void
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

    public function getSS(): ?string
    {
        return $this->ss;
    }

    public function setSS(?string $ss): void
    {
        $this->ss = $ss;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
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

    public function getFlagOculto(): ?int
    {
        return $this->flagOculto;
    }

    public function setFlagOculto(?int $valor): self
    {
        $this->flagOculto = $valor;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
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

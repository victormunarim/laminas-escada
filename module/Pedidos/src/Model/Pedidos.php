<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Pedidos\Constantes\ConstantesPedidos;

class Pedidos extends \ArrayObject implements InputFilterAwareInterface
{
    private ?int $id = null;

    private ?int $numeroPedido = null;

    private ?int $clienteId = null;

    private ?int $cpf = null;

    private ?int $rg = null;

    private ?string $profissao = null;

    private ?string $cnpj = null;

    private ?string $email = null;

    private ?string $admObra = null;

    private ?int $telefone = null;

    private ?int $telefoneFixo = null;

    private ?string $descricao = null;

    private ?string $acabamento = null;

    private ?string $tubos = null;

    private ?bool $revestimento = null;

    private ?float $valorTotal = null;

    private ?int $prazoMontagem = null;

    private ?\DateTime $data = null;

    private ?InputFilterInterface $inputFilter = null;

    /**
     * @param array<string, mixed> $array
     */
    public function exchangeArray(array|object $array): array
    {
        $this->setId(! empty($array[ConstantesPedidos::ID_NAME]) ? (int) $array[ConstantesPedidos::ID_NAME] : null);

        $this->setNumeroPedido(
            ! empty($array[ConstantesPedidos::NUMERO_PEDIDO_NAME])
                ? (int) $array[ConstantesPedidos::NUMERO_PEDIDO_NAME]
                : null
        );

        $this->setClienteId(
            ! empty($array[ConstantesPedidos::CLIENTE_ID_NAME])
                ? (int) $array[ConstantesPedidos::CLIENTE_ID_NAME]
                : null
        );

        $this->setCpf(
            ! empty($array[ConstantesPedidos::CPF_NAME])
                ? (int) $array[ConstantesPedidos::CPF_NAME]
                : null
        );

        $this->setRg(
            ! empty($array[ConstantesPedidos::RG_NAME])
                ? (int) $array[ConstantesPedidos::RG_NAME]
                : null
        );

        $this->setProfissao(
            ! empty($array[ConstantesPedidos::PROFISSAO_NAME])
                ? (string) $array[ConstantesPedidos::PROFISSAO_NAME]
                : null
        );

        $this->setCnpj(
            ! empty($array[ConstantesPedidos::CNPJ_NAME])
                ? (string) $array[ConstantesPedidos::CNPJ_NAME]
                : null
        );

        $this->setEmail(
            ! empty($array[ConstantesPedidos::EMAIL_NAME])
                ? (string) $array[ConstantesPedidos::EMAIL_NAME]
                : null
        );

        $this->setAdmObra(
            ! empty($array[ConstantesPedidos::ADM_OBRA_NAME])
                ? (string) $array[ConstantesPedidos::ADM_OBRA_NAME]
                : null
        );

        $this->setTelefone(
            ! empty($array[ConstantesPedidos::TELEFONE_NAME])
                ? (int) $array[ConstantesPedidos::TELEFONE_NAME]
                : null
        );

        $this->setTelefoneFixo(
            ! empty($array[ConstantesPedidos::TELEFONE_FIXO_NAME])
                ? (int) $array[ConstantesPedidos::TELEFONE_FIXO_NAME]
                : null
        );

        $this->setDescricao(
            ! empty($array[ConstantesPedidos::DESCRICAO_NAME])
                ? (string) $array[ConstantesPedidos::DESCRICAO_NAME]
                : null
        );

        $this->setRevestimento(
            ! empty($array[ConstantesPedidos::REVESTIMENTO_NAME])
                ? (bool) $array[ConstantesPedidos::REVESTIMENTO_NAME]
                : null
        );

        $this->setValorTotal(
            ! empty($array[ConstantesPedidos::VALOR_TOTAL_NAME])
                ? (float) $array[ConstantesPedidos::VALOR_TOTAL_NAME]
                : null
        );

        $this->setPrazoMontagem(
            ! empty($array[ConstantesPedidos::PRAZO_MONTAGEM_NAME])
                ? (int) $array[ConstantesPedidos::PRAZO_MONTAGEM_NAME]
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
            ConstantesPedidos::NUMERO_PEDIDO_NAME => $this->numeroPedido,
            ConstantesPedidos::CLIENTE_ID_NAME => $this->clienteId,
            ConstantesPedidos::CPF_NAME => $this->cpf,
            ConstantesPedidos::RG_NAME => $this->rg,
            ConstantesPedidos::PROFISSAO_NAME => $this->profissao,
            ConstantesPedidos::CNPJ_NAME => $this->cnpj,
            ConstantesPedidos::EMAIL_NAME => $this->email,
            ConstantesPedidos::ADM_OBRA_NAME => $this->admObra,
            ConstantesPedidos::TELEFONE_NAME => $this->telefone,
            ConstantesPedidos::TELEFONE_FIXO_NAME => $this->telefoneFixo,
            ConstantesPedidos::DESCRICAO_NAME => $this->descricao,
            ConstantesPedidos::REVESTIMENTO_NAME => $this->revestimento,
            ConstantesPedidos::VALOR_TOTAL_NAME => $this->valorTotal,
            ConstantesPedidos::PRAZO_MONTAGEM_NAME => $this->prazoMontagem,
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

    public function getNumeroPedido(): ?int
    {
        return $this->numeroPedido;
    }

    public function setNumeroPedido(?int $numero): void
    {
        $this->numeroPedido = $numero;
    }

    public function getClienteId(): ?int
    {
        return $this->clienteId;
    }

    public function setClienteId(?int $clienteId): void
    {
        $this->clienteId = $clienteId;
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

    public function getProfissao(): ?string
    {
        return $this->profissao;
    }

    public function setProfissao(?string $profissao): void
    {
        $this->profissao = $profissao;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): void
    {
        $this->cnpj = $cnpj;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getAdmObra(): ?string
    {
        return $this->admObra;
    }

    public function setAdmObra(?string $admObra): void
    {
        $this->admObra = $admObra;
    }

    public function getTelefone(): ?int
    {
        return $this->telefone;
    }

    public function setTelefone(?int $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function getTelefoneFixo(): ?int
    {
        return $this->telefoneFixo;
    }

    public function setTelefoneFixo(?int $telefoneFixo): void
    {
        $this->telefoneFixo = $telefoneFixo;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getAcabamento(): ?string
    {
        return $this->acabamento;
    }

    public function setAcabamento(?string $acabamento): void
    {
        $this->acabamento = $acabamento;
    }

    public function getTubos(): ?string
    {
        return $this->tubos;
    }

    public function setTubos(?string $tubos): void
    {
        $this->tubos = $tubos;
    }

    public function getRevestimento(): ?bool
    {
        return $this->revestimento;
    }

    public function setRevestimento(?bool $revestimento): void
    {
        $this->revestimento = $revestimento;
    }

    public function getValorTotal(): ?float
    {
        return $this->valorTotal;
    }

    public function setValorTotal(?float $valorTotal): void
    {
        $this->valorTotal = $valorTotal;
    }

    public function getPrazoMontagem(): ?int
    {
        return $this->prazoMontagem;
    }

    public function setPrazoMontagem(?int $prazoMontagem): void
    {
        $this->prazoMontagem = $prazoMontagem;
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

<?php

declare(strict_types=1);

namespace Pedidos\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Pedidos\Constantes\ConstantesPedidos;

class Pedidos implements InputFilterAwareInterface
{
    private ?int $id = null;
    private ?int $numeroPedido = null;
    private ?string $email = null;
    private ?int $cpf = null;
    private ?int $rg = null;
    private ?string $cnpj = null;
    private ?string $servicoSocial = null;
    private ?int $numeroCliente = null;
    private ?string $bairroCliente = null;
    private ?string $cidadeCliente = null;
    private ?int $cepCliente = null;
    private ?string $referenciaCliente = null;
    private ?string $profissao = null;
    private ?string $admObra = null;
    private ?int $telefone = null;
    private ?int $telefoneFixo = null;
    private ?string $descricao = null;
    private ?string $acabamento = null;
    private ?string $tubos = null;
    private ?bool $revestimento = null;
    private ?float $valorTotal = null;
    private ?int $prazoMontagem = null;
    private ?int $flagOculto = null;
    private ?string $clienteNome = null;
    private ?int $numero = null;
    private ?string $bairro = null;
    private ?string $cidade = null;
    private ?string $cep = null;
    private ?string $referencia = null;

    /**
     * @param array<string,mixed> $array
     */
    public function exchangeArray(array|object $array): void
    {
        $this->id = ! empty($array[ConstantesPedidos::ID_NAME])
            ? (int) $array[ConstantesPedidos::ID_NAME]
            : null;

        $this->numeroPedido = ! empty($array[ConstantesPedidos::NUMERO_PEDIDO_NAME])
            ? (int) $array[ConstantesPedidos::NUMERO_PEDIDO_NAME]
            : null;

        $this->clienteNome = ! empty($array[ConstantesPedidos::CLIENTE_NOME_NAME])
            ? (string) $array[ConstantesPedidos::CLIENTE_NOME_NAME]
            : null;

        $this->email = ! empty($array[ConstantesPedidos::EMAIL_NAME])
            ? (string) $array[ConstantesPedidos::EMAIL_NAME]
            : null;

        $this->cpf = ! empty($array[ConstantesPedidos::CPF_NAME])
            ? (int) $array[ConstantesPedidos::CPF_NAME]
            : null;

        $this->rg = ! empty($array[ConstantesPedidos::RG_NAME])
            ? (int) $array[ConstantesPedidos::RG_NAME]
            : null;

        $this->cnpj = ! empty($array[ConstantesPedidos::CNPJ_NAME])
            ? (string) $array[ConstantesPedidos::CNPJ_NAME]
            : null;

        $this->servicoSocial = ! empty($array[ConstantesPedidos::SS_NAME])
            ? (string) $array[ConstantesPedidos::SS_NAME]
            : null;

        $this->numeroCliente = ! empty($array[ConstantesPedidos::NUMERO_CLIENTE_NAME])
            ? (int) $array[ConstantesPedidos::NUMERO_CLIENTE_NAME]
            : null;

        $this->bairroCliente = ! empty($array[ConstantesPedidos::BAIRRO_CLIENTE_NAME])
            ? (string) $array[ConstantesPedidos::BAIRRO_CLIENTE_NAME]
            : null;

        $this->cidadeCliente = ! empty($array[ConstantesPedidos::CIDADE_CLIENTE_NAME])
            ? (string) $array[ConstantesPedidos::CIDADE_CLIENTE_NAME]
            : null;

        $this->cepCliente = ! empty($array[ConstantesPedidos::CEP_CLIENTE_NAME])
            ? (int) $array[ConstantesPedidos::CEP_CLIENTE_NAME]
            : null;

        $this->referenciaCliente = ! empty($array[ConstantesPedidos::REFERENCIA_CLIENTE_NAME])
            ? (string) $array[ConstantesPedidos::REFERENCIA_CLIENTE_NAME]
            : null;

        $this->profissao = ! empty($array[ConstantesPedidos::PROFISSAO_NAME])
            ? (string) $array[ConstantesPedidos::PROFISSAO_NAME]
            : null;

        $this->admObra = ! empty($array[ConstantesPedidos::ADM_OBRA_NAME])
            ? (string) $array[ConstantesPedidos::ADM_OBRA_NAME]
            : null;

        $this->telefone = ! empty($array[ConstantesPedidos::TELEFONE_NAME])
            ? (int) $array[ConstantesPedidos::TELEFONE_NAME]
            : null;

        $this->telefoneFixo = ! empty($array[ConstantesPedidos::TELEFONE_FIXO_NAME])
            ? (int) $array[ConstantesPedidos::TELEFONE_FIXO_NAME]
            : null;

        $this->descricao = ! empty($array[ConstantesPedidos::DESCRICAO_NAME])
            ? (string) $array[ConstantesPedidos::DESCRICAO_NAME]
            : null;

        $this->acabamento = ! empty($array[ConstantesPedidos::ACABAMENTO_NAME])
            ? (string) $array[ConstantesPedidos::ACABAMENTO_NAME]
            : null;

        $this->tubos = ! empty($array[ConstantesPedidos::TUBOS_NAME])
            ? (string) $array[ConstantesPedidos::TUBOS_NAME]
            : null;

        $this->revestimento = ! empty($array[ConstantesPedidos::REVESTIMENTO_NAME])
            ? (bool) $array[ConstantesPedidos::REVESTIMENTO_NAME]
            : null;

        $this->valorTotal = ! empty($array[ConstantesPedidos::VALOR_TOTAL_NAME])
            ? (float) $array[ConstantesPedidos::VALOR_TOTAL_NAME]
            : null;

        $this->prazoMontagem = ! empty($array[ConstantesPedidos::PRAZO_MONTAGEM_NAME])
            ? (int) $array[ConstantesPedidos::PRAZO_MONTAGEM_NAME]
            : null;

        $this->flagOculto = ! empty($array[ConstantesPedidos::FLAG_OCULTO_NAME])
            ? (int) $array[ConstantesPedidos::FLAG_OCULTO_NAME]
            : 0;

        $this->numero = ! empty($array[ConstantesPedidos::NUMERO_NAME])
            ? (int)$array[ConstantesPedidos::NUMERO_NAME]
            : null;

        $this->bairro = ! empty($array[ConstantesPedidos::BAIRRO_NAME])
            ? (string)$array[ConstantesPedidos::BAIRRO_NAME]
            : null;

        $this->cidade = ! empty($array[ConstantesPedidos::CIDADE_NAME])
            ? (string)$array[ConstantesPedidos::CIDADE_NAME]
            : null;

        $this->cep = ! empty($array[ConstantesPedidos::CEP_NAME])
            ? (string)$array[ConstantesPedidos::CEP_NAME]
            : null;

        $this->referencia = ! empty($array[ConstantesPedidos::REFERENCIA_NAME])
            ? (string)$array[ConstantesPedidos::REFERENCIA_NAME]
            : null;
    }

    /**
     * @return array<string,int|string|float|bool|null>
     */
    public function getArrayCopy(): array
    {
        return [
            ConstantesPedidos::ID_NAME => $this->id,
            ConstantesPedidos::NUMERO_PEDIDO_NAME => $this->numeroPedido,
            ConstantesPedidos::CLIENTE_NOME_NAME => $this->clienteNome,
            ConstantesPedidos::PROFISSAO_NAME => $this->profissao,
            ConstantesPedidos::ADM_OBRA_NAME => $this->admObra,
            ConstantesPedidos::TELEFONE_NAME => $this->telefone,
            ConstantesPedidos::TELEFONE_FIXO_NAME => $this->telefoneFixo,
            ConstantesPedidos::DESCRICAO_NAME => $this->descricao,
            ConstantesPedidos::ACABAMENTO_NAME => $this->acabamento,
            ConstantesPedidos::TUBOS_NAME => $this->tubos,
            ConstantesPedidos::REVESTIMENTO_NAME => $this->revestimento,
            ConstantesPedidos::VALOR_TOTAL_NAME => $this->valorTotal,
            ConstantesPedidos::PRAZO_MONTAGEM_NAME => $this->prazoMontagem,
            ConstantesPedidos::FLAG_OCULTO_NAME => $this->flagOculto,
            ConstantesPedidos::NUMERO_NAME => $this->numero,
            ConstantesPedidos::BAIRRO_NAME => $this->bairro,
            ConstantesPedidos::CIDADE_NAME => $this->cidade,
            ConstantesPedidos::CEP_NAME => $this->cep,
            ConstantesPedidos::REFERENCIA_NAME => $this->referencia,
            ConstantesPedidos::EMAIL_NAME => $this->email,
            ConstantesPedidos::CPF_NAME => $this->cpf,
            ConstantesPedidos::RG_NAME => $this->rg,
            ConstantesPedidos::CNPJ_NAME => $this->cnpj,
            ConstantesPedidos::SS_NAME => $this->servicoSocial,
            ConstantesPedidos::NUMERO_CLIENTE_NAME => $this->numeroCliente,
            ConstantesPedidos::BAIRRO_CLIENTE_NAME => $this->bairroCliente,
            ConstantesPedidos::CIDADE_CLIENTE_NAME => $this->cidadeCliente,
            ConstantesPedidos::CEP_CLIENTE_NAME => $this->cepCliente,
            ConstantesPedidos::REFERENCIA_CLIENTE_NAME => $this->referenciaCliente,
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
    public function getProfissao(): ?string
    {
        return $this->profissao;
    }
    public function setProfissao(?string $profissao): void
    {
        $this->profissao = $profissao;
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
    public function getFlagOculto(): ?int
    {
        return $this->flagOculto;
    }
    public function setFlagOculto(?int $valor): void
    {
        $this->flagOculto = $valor;
    }
    public function getClienteNome(): ?string
    {
        return $this->clienteNome;
    }
    public function setClienteNome(?string $nome): void
    {
        $this->clienteNome = $nome;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getCpf(): ?int
    {
        return $this->cpf;
    }

    public function setCpf(?int $cpf): self
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getRg(): ?int
    {
        return $this->rg;
    }

    public function setRg(?int $rg): self
    {
        $this->rg = $rg;
        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): self
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getServicoSocial(): ?string
    {
        return $this->servicoSocial;
    }

    public function setServicoSocial(?string $servicoSocial): self
    {
        $this->servicoSocial = $servicoSocial;
        return $this;
    }

    public function getNumeroCliente(): ?int
    {
        return $this->numeroCliente;
    }

    public function setNumeroCliente(?int $numeroCliente): self
    {
        $this->numeroCliente = $numeroCliente;
        return $this;
    }

    public function getBairroCliente(): ?string
    {
        return $this->bairroCliente;
    }

    public function setBairroCliente(?string $bairroCliente): self
    {
        $this->bairroCliente = $bairroCliente;
        return $this;
    }

    public function getCidadeCliente(): ?string
    {
        return $this->cidadeCliente;
    }

    public function setCidadeCliente(?string $cidadeCliente): self
    {
        $this->cidadeCliente = $cidadeCliente;
        return $this;
    }

    public function getCepCliente(): ?int
    {
        return $this->cepCliente;
    }

    public function setCepCliente(?int $cepCliente): self
    {
        $this->cepCliente = $cepCliente;
        return $this;
    }

    public function getReferenciaCliente(): ?string
    {
        return $this->referenciaCliente;
    }

    public function setReferenciaCliente(?string $referenciaCliente): self
    {
        $this->referenciaCliente = $referenciaCliente;
        return $this;
    }

    public function setInputFilter(InputFilterInterface $inputFilter): void
    {
    }
    public function getInputFilter(): ?InputFilterInterface
    {
        return null;
    }
}

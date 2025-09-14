<?php

declare(strict_types=1);

namespace Escada\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class Pedidos implements InputFilterAwareInterface
{
    public $id;
    public $nome;
    public $idade;
    private $inputFilter;

    public function exchangeArray(array $array): void
    {
        $this->id = ! empty($array['id']) ? $array['id'] : null;
        $this->nome = ! empty($array['nome']) ? $array['nome'] : null;
        $this->idade = ! empty($array['idade']) ? $array['idade'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'idade' => $this->idade,
        ];
    }


    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        // TODO: Implement setInputFilter() method.
    }

    public function getInputFilter()
    {
        // TODO: Implement getInputFilter() method.
    }
}

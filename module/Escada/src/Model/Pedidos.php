<?php

namespace Escada\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class Pedidos implements InputFilterAwareInterface
{
    public $id;
    public $nome;
    private $inputFilter;

    public function exchangeArray(array $array): void
    {
        $this->id = ! empty($array['id']) ? $array['id'] : null;
        $this->nome = ! empty($array['nome']) ? $array['nome'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
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

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        // TODO: Implement setInputFilter() method.
    }

    public function getInputFilter()
    {
        // TODO: Implement getInputFilter() method.
    }
}

<?php

namespace Source\Models\Records;

Class Address extends Model{
    protected $id;  
    protected $idForeign;
    protected $zipCode;
    protected $street;
    protected $number;
    protected $complement;

    public function __construct( 
    int $id = null, 
    int $idForeign,
    string $zipCode = null, 
    string $street = null, 
    string $number = null, 
    string $complement = null
    ){
        $this->id = $id;
        $this->idForeign = $idForeign;
        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
 
    public function getIdForeign()
    {
        return $this->idForeign;
    }

    public function setIdForeign($idForeign)
    {
        $this->idForeign = $idForeign;

        return $this;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    public function getComplement()
    {
        return $this->complement;
    }

    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }
}
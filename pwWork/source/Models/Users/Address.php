<?php

namespace Source\Models\Users;

use Source\Core\Model;

Class Address extends Model{
    protected $id;  
    protected $idForeign;
    protected $zipCode;
    protected $street;
    protected $number;
    protected $complement;

    public function __construct( 
    int $id = null, 
    int $idForeign = null,
    String $zipCode = null, 
    String $street = null, 
    String $number = null, 
    String $complement = null
    ){
        $this->id = $id;
        $this->idForeign = $idForeign;
        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
        $this -> table = "address";

    }
    
    public function getId(): ?int 
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
 
    public function getIdForeign(): ?int
    {
        return $this->idForeign;    
    }

    public function setIdForeign(?int $idForeign): void
    {
        $this->idForeign = $idForeign;
    }

    public function getZipCode(): ?String 
    {
        return $this->zipCode;
    }

    public function setZipCode(?String $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getStreet(): ?String
    {
        return $this->street;
    }

    public function setStreet(?String $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): ?String
    {
        return $this->number;
    }

    public function setNumber(?String $number): void
    {
        $this->number = $number;
    }

    public function getComplement(): ?String
    {
        return $this->complement;
    }

    public function setComplement(?String $complement): void
    {
        $this->complement = $complement;
    }
}
<?php

require  __DIR__ . "/../vendor/autoload.php";

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
        $this -> table = "adress";

    }
    
    public function getId(): ?int 
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;

        return $this;
    }
 
    public function getIdForeign(): ?int
    {
        return $this->idForeign;    
    }

    public function setIdForeign(?String $idForeign): void
    {
        $this->idForeign = $idForeign;

        return $this;
    }

    public function getZipCode(): ?String 
    {
        return $this->zipCode;
    }

    public function setZipCode(?String $zipCode): void
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getStreet(): ?String
    {
        return $this->street;
    }

    public function setStreet(?String $street): void
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): ?String
    {
        return $this->number;
    }

    public function setNumber(?String $number): void
    {
        $this->number = $number;

        return $this;
    }

    public function getComplement(): ?String
    {
        return $this->complement;
    }

    public function setComplement(?String $complement): void
    {
        $this->complement = $complement;

        return $this;
    }
}
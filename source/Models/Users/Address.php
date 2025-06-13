<?php

namespace Source\Models\Users;

use Source\Core\Model;

Class Address extends Model{
    protected $id;  
    protected $idUser;
    protected $zipCode;
    protected $street;
    protected $number;
    protected $complement;
    protected $state;
    protected $city;

    public function __construct( 
    int $id = null, 
    int $idUser = null,
    String $zipCode = null, 
    String $street = null, 
    String $number = null, 
    String $complement = null,
    String $state = null,
    String $city = null,
    ){
        $this->id = $id;
        $this->idUser = $idUser;
        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
        $this->state = $state;
        $this->city = $city;
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
 
    public function getIdUser(): ?int
    {
        return $this->idUser;    
    }

    public function setIdUser(?int $idUser): void
    {
        $this->idUser = $idUser;
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
     
    public function getState(): ?String
    {
        return $this->state;
    }

    public function setState(?String $state): void
    {
        $this->State = $state;
    } 
    
    public function getCity(): ?String
    {
        return $this->city;
    }

    public function setCity(?String $city): void
    {
        $this->city = $city;
    }
}
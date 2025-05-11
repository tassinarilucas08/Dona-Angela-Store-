<?php

namespace Source\Models\Records;

Class Address{
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
}
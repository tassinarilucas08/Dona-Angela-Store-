<?php

namespace Source\Models\Hospital;

use Source\Models\User;

class Patient extends User{
    private $dateBirth;
    private $record;

    public function __construct (
        int $id = null,
        int $idType = null,
        String $name = null, 
        String $email = null,
        String $password = null,
        String $photo = null,
        String $dateBirth = null,
        String $record = null
       ){
        parent::__construct($id, $idType, $name, $email, $password, $photo);
        $this->dateBirth = $dateBirth;
        $this->record = $record; 
       }

    public function getDateBirth (): ?string
    {
        return $this->dateBirth;
    }

    public function setDateBirth (?string $dateBirth): void
    {
        $this->dateBirth = $dateBirth;
    }
    
    public function getRecord (): ?int
    {
        return $this->record;
    }

    public function setRecord (?int $record): void
    {
        $this->record = $record;
    }
}
<?php

namespace Source\Models\Hospital;

use Source\Models\User;

class Doctor extends User{

    private $crm;
    private $specialty;
    
    public function __construct (
        int $id = null,
        int $idType = null,
        String $name = null,
        String $email = null,
        String $password = null,
        String $photo = null,
        String $crm = null,
        String $specialty = null,
       ){
        parent::__construct($id, $idType, $name, $email, $password, $photo);
        $this->crm = $crm;
        $this->specialty = $specialty; 
       }

    public function getCrm (): ?string
    {
        return $this->crm;
    }

    public function setCrm (?string $crm): void
    {
        $this->crm = $crm;
    }
    
    public function getSpecialty (): ?int
    {
        return $this->specialty;
    }

    public function setSpecialty (?int $specialty): void
    {
        $this->specialty = $specialty;
    }
}
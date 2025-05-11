<?php

namespace Source\Models\Employee;

use Source\Models\Employee\Employee;

class Seller extends Employee{
    
    private $sales;

    public function __construct (
        int $id = null,
        int $idType = null,
        String $name = null,
        String $email = null,
        String $password = null,
        String $photo = null,
        int $hours = null,
        float $valueHour = null,
        float $sales = null
       ){
        parent::__construct($id, $idType, $name, $email, $password, $photo, $hours, $valueHour);
        $this->sales = $sales;
        $this->salary = $this->salary + ($sales * 0.1);
       }

       public function getSales (): ?float{
        return $this->sales;
    }

    public function setSales(?float $sales): void{
        $this->sales = $sales;
        $this->salary = ($this->hours * $this->valueHour) + ($this->sales * 0.1);
    }

    public function setValueHours (?int $valueHour): void
    {
        $this->valueHour = $valueHour;
        $this->salary = ($this->hours * $this->valueHour) + ($this->sales * 0.1);
    }

    public function setHours (?int $hours): void
    {
        $this->hours = $hours;
        $this->salary = ($this->hours * $this->valueHour) + ($this->sales * 0.1);
    }
}
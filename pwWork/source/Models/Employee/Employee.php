<?php

namespace Source\Models\Employee;

use Source\Models\User;

class Employee extends User{
    protected $salary;
    protected $hours;
    protected $valueHour;

    public function __construct (
        int $id = null,
        int $idType = null,
        String $name = null,
        String $email = null,
        String $password = null,
        String $photo = null,
        int $hours = null,
        float $valueHour = null
       ){
        parent::__construct($id, $idType, $name, $email, $password, $photo);
        $this->hours = $hours;
        $this->valueHour = $valueHour;
        $this->salary = $this->hours * $this->valueHour;
       }
       
    public function getSalary (): ?float
    {
        return $this->salary;
    }
    
    public function getHours (): ?int
    {
        return $this->hours;
    }

    public function setHours (?int $hours): void
    {
        $this->hours = $hours;
        $this->salary = $this->hours * $this->valueHours;
    }

    public function getValueHour (): ?int
    {
        return $this->ValueHour;
    }

    public function setValueHours (?int $valueHours): void
    {
        $this->valueHours = $valueHours;
        $this->salary = $this->hours * $this->valueHours;
    }
}

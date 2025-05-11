<?php

namespace Source\Models\Game;

class Ladrao extends Personagem
{
    protected $agility;

    public function __construct (
        string $name = null, 
        int $health = null, 
        int $energy = null, 
        int $power = null,
        int $agility = null 
        )       
    {
        parent::__construct($name, $health, $energy, $power);
        $this->agility = $agility;
    }

    public function getAgility (): ?int
    {
        return $this->agility;
    }

    public function setAgility (?int $agility): void
    {
        $this->agility = $agility;
    }

}
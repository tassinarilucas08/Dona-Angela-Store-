<?php

namespace Source\Models\Game;

class Guerreiro extends Personagem
{
    protected $defense;

    public function __construct (
        string $name = null, 
        int $health = null, 
        int $energy = null, 
        int $power = null,
        int $defense = null 
        )       
    {
        parent::__construct($name, $health, $energy, $power);
        $this->defense = $defense;
    }

    public function getDefense (): ?int
    {
        return $this->defense;
    }

    public function setDefense (?int $defense): void
    {
        $this->defense = $defense;
    }
}
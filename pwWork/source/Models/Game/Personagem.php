<?php

namespace Source\Models\Game;

class Personagem
{
    protected $name;
    protected $health;
    protected $energy;
    protected $power;

    public function __construct (
        string $name = null, 
        int $health = null, 
        int $energy = null, 
        int $power = null, 
        )       
    {
        $this->name = $name;
        $this->health = $health;
        $this->energy = $energy;
        $this->power = $power;
    }

    public function getName (): ?string
    {
        return $this->name;
    }

    public function setName (?string $name): void
    {
        $this->name = $name;
    }

    public function getHealth (): ?int
    {
        return $this->health;
    }

    public function setHealth (?int $health): void
    {
        $this->health = $health;
    }
    public function getEnergy (): ?int
    {
        return $this->energy;
    }

    public function setEnergy (?int $energy): void
    {
        $this->energy = $energy;
    }
    public function getPower (): ?int
    {
        return $this->power;
    }

    public function setPower (?int $power): void
    {
        $this->power = $power;
    }

}
<?php

namespace Source\Models\Game;

class Mago extends Personagem
{
    protected $intelligence;

    public function __construct (
        string $name = null, 
        int $health = null, 
        int $energy = null, 
        int $power = null,
        int $intelligence = null 
        )       
    {
        parent::__construct($name, $health, $energy, $power);
        $this->intelligence = $intelligence;    
    }

    public function getintelligence (): ?int
    {
        return $this->intelligence;
    }

    public function setintelligence (?int $intelligence): void
    {
        $this->intelligence = $intelligence;
    }


}
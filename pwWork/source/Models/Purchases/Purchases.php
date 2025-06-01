<?php

namespace Source\Models\Purchases;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;

class Purchases extends Model
{    
    protected $id;
    protected $idClient;
    protected $date;
    protected $total;
    
    public function __construct(int $id = null, int $idClient = null, date $date = null, float $total = null)
{
    $this->id = $id;
    $this->idClient = $idClient;
    $this->date = $date;
    $this->total = $total;
    $this->table = "purchases";
 }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function setIdClient(?int $idClient): void
    {
        $this->idClient = $idClient;
    }

    public function getDate(): ?date
    {
        return $this->date;
    }

    public function setDate(?date $date): void
    {
        $this->date = $date;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }
    public function setTotal(?float $total): void
    {
        $this->total = $total;
    }
}
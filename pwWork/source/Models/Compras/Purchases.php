<?php
require  __DIR__ . "/../vendor/autoload.php";

namespace Source\Models\Compras;

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

    public function getIdClient(): ?String
    {
        return $this->idClient;
    }

    public function setIdClient(?String $idClient): void
    {
        $this->idClient = $idClient;
    }

    public function getDate(): ?float
    {
        return $this->date;
    }

    public function setDate(?float $date): void
    {
        $this->date = $date;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }
    public function setTotal(?int $total): void
    {
        $this->total = $total;
    }
}
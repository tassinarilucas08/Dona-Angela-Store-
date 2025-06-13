<?php

namespace Source\Models\Purchases;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;

class Purchases extends Model
{    
    protected $id;
    protected $idUser;
    protected $date;
    protected $total;
    
    public function __construct(int $id = null, int $idUser = null, date $date = null, float $total = null)
{
    $this->id = $id;
    $this->idUser = $idUser;
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

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): void
    {
        $this->idUser = $idUser;
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
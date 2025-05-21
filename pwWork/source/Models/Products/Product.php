<?php
require  __DIR__ . "/../vendor/autoload.php";

namespace Source\Models\Products;

use Source\Core\Model;

class Product extends Model
{    
    private $idCategory;
    private $id;
    private $name;
    private $price;

    public function __construct(int $id = null, String $name = null, float $price = null, int $idCategory = null)
{
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->idCategory = $idCategory;
    $this->table = "products";
 }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?String
    {
        return $this->name;
    }

    public function setName(?String $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
    }
    public function setIdCategory(?int $idCategory): void
    {
        $this->idCategory = $idCategory;
    }
}
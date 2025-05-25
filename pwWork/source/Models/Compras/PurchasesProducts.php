<?php
require  __DIR__ . "/../vendor/autoload.php";

namespace Source\Models\Compras;

use Source\Core\Model;

class PurchasesProducts extends Model
{    
    protected $id;
    protected $idCompra;
    protected $idProduto;
    protected $quantity;
    protected $value;
    
    public function __construct(int $id = null, int $idCompra = null, int $idProduto = null, int $quantity =, float $value = null)
{
    $this->id = $id;
    $this->idCompra = $idCompra;
    $this->idProduto = $idProduto;
    $this->quantity = $quantity;
    $this->value = $value;
    $this->table = "purchasesProducts";
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


    public function getDescription(): ?String
    {
        return $this->description;
    }

    public function setDescription(?String $description): void
    {
        $this->description = $description;

        return $this;
    }
}
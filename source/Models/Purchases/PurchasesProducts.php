<?php
namespace Source\Models\Purchases;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;

class PurchasesProducts extends Model
{    
    protected $id;
    protected $idPurchase;
    protected $idProduct;
    protected $quantity;
    protected $value;
    
    public function __construct(int $id = null, int $idPurchase = null, int $idProduct = null, int $quantity = null, float $value = null)
{
    $this->id = $id;
    $this->idPurchase = $idPurchase;
    $this->idProduct = $idProduct;
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

    public function getIdPurchase(): ?int
    {
        return $this->idPurchase;
    }

    public function setIdPurchase(?int $idPurchase): void
    {
        $this->idPurchase = $idPurchase;
    }

    public function getIdProduct(): ?int
    {
        return $this->idProduct;
    }

    public function setIdProduct(?int $idProduct): void
    {
        $this->idProduct = $idProduct;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): void
    {
        $this->value = $value;
    }
}
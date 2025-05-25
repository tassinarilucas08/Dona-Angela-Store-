<?php
namespace Source\Models\Compras;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;

class PurchasesProducts extends Model
{    
    protected $id;
    protected $idCompra;
    protected $idProduto;
    protected $quantity;
    protected $value;
    
    public function __construct(int $id = null, int $idCompra = null, int $idProduto = null, int $quantity = null, float $value = null)
{
    $this->id = $id;
    $this->idCompra = $idCompra;
    $this->idProduto = $idProduto;
    $this->quantity = $quantity;
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

    public function getIdCompra(): ?int
    {
        return $this->idCompra;
    }

    public function setIdCompra(?int $idCompra): void
    {
        $this->idCompra = $idCompra;
    }

    public function getIdProduto(): ?int
    {
        return $this->idProduto;
    }

    public function setIdProduto(?int $idProduto): void
    {
        $this->idProduto = $idProduto;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }


    public function getDescription(): ?String
    {
        return $this->description;
    }

    public function setDescription(?String $description): void
    {
        $this->description = $description;
    }
}
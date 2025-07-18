<?php

namespace Source\Models\Products;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;

class Product extends Model
{   
    private $id; 
    private $idCategory;
    private $name;
    private $price;
    private $description;
    private $photo;
    private $quantity;
    private $status;
    private $deletedAt;

    public function __construct(int $id = null, int $idCategory = null, String $name = null, float $price = null, String $description, int $photo, int $quantity, String $status, String $deletedAt = null)
{
    $this->id = $id;
    $this->idCategory = $idCategory;
    $this->name = $name;
    $this->price = $price;
    $this->description = $description;
    $this->photo = $photo;
    $this->quantity = $quantity;
    $this->status = $status;
    $this->deletedAt = $deletedAt;
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

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
    }
    public function setIdCategory(?int $idCategory): void
    {
        $this->idCategory = $idCategory;
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

    public function getDescription(): ?String
    {
        return $this->description;
    }

    public function setDescription(?String $description): void
    {
        $this->description = $description;
    }

    public function getPhoto(): ?int
    {
        return $this->photo;
    }

    public function setPhoto(?int $photo): void
    {
        $this->photo = $photo;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getStatus(): ?String
    {
        return $this->status;
    }

    public function setStatus(?String $status): void
    {
        $this->status = $status;
    }

     public function getDeletedAt(): ?String
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?String $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
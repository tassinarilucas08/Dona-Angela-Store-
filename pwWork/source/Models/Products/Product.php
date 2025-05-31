<?php

namespace Source\Models\Products;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;

class Product extends Model
{    
    private $idCategory;
    private $id;
    private $name;
    private $price;
    private $description;
    private $photo;
    private $deletedAt;

    public function __construct(int $id = null, String $name = null, float $price = null, int $idCategory = null, String $description, String $photo, String $deletedAt = null)
{
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->idCategory = $idCategory;
    $this->description = $description;
    $this->photo = $photo;
    $this->deletedAt = $deletedAt
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

    public function getDescription(): ?String
    {
        return $this->description;
    }

    public function setDescription(?String $description): void
    {
        $this->description = $description;
    }

    public function getPhoto(): ?String
    {
        return $this->photo;
    }

    public function setPhoto(?String $photo): void
    {
        $this->photo = $photo;
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
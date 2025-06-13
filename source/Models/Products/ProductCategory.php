<?php

namespace Source\Models;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;

class ProductCategory extends Model
{
    private $id;
    private $idGender;
    private $description;

    public function __construct(int $id = null, int $idGender = null, String $description = null)
{
    $this->id = $id;
    $this->idGender = $idGender;
    $this->description = $description;
    $this->table = "products_categories";
 }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdGender(): ?int
    {
        return $this->idGender;
    }

    public function setIdGender(?int $idGender): void
    {
        $this->idGender = $idGender;
    }

    public function getDescription(): ?String
    {
        return $this->description;
    }

    public function setDescription(?int $description): void
    {
        $this->description = $description;
    }
}
<?php

namespace Source\Models;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;

class ProductCategory extends Model
{
    private $id;
    private $idGender;
    private $name;

    public function __construct(int $id = null, String $idGender = null, String $name = null)
{
    $this->id = $id;
    $this->idGender = $idGender;
    $this->name = $name;
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

    public function getName(): ?String
    {
        return $this->name;
    }

    public function setName(?int $name): void
    {
        $this->name = $name;
    }
}
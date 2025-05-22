<?php
require  __DIR__ . "/../vendor/autoload.php";

namespace Source\Models;

use Source\Core\Model;

class ProductCategory extends Model
{
    private $idGender;
    private $id;
    private $name;

    public function __construct(int $id = null, String $name = null, String $gender = null)
{
    $this->gender = $idGender
    $this->id = $id;
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

        return $this;
    }

    public function getName(): ?String
    {
        return $this->name;
    }

    public function setName(?int $name): void
    {
        $this->name = $name;

        return $this;
    }

    public function getIdGender(): ?int
    {
        return $this->idGender;
    }

    public function setIdGender(?int $idGender): void
    {
        $this->idGender = $idGender;

        return $this;
    }
}
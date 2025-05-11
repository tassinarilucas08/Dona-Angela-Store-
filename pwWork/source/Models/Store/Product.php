<?php

namespace Source\Models\Store;

use Source\Core\Model;

class Product extends Model
{
    private $id;
    private $name;
    private $price;
    private $idCategory;

    public function __construct(int $id = null, String $name = null, float $price = null, int $idCategory = null)
{
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->idCategory = $idCategory;
    $this->table = "products";
 }
}
    // public function getId()
    // {
    //     return $this->id;
    // }

    // public function setId($id)
    // {
    //     $this->id = $id;
    // }

    // public function getName()
    // {
    //     return $this->name;
    // }

    // public function setName($name)
    // {
    //     $this->name = $name;
    // }

    // public function getPrice()
    // {
    //     return $this->price;
    // }

    // public function setPrice($price)
    // {
    //     $this->price = $price;
    // }

    // public function getIdCategory()
    // {
    //     return $this->idCategory;
    // }
    // public function setIdCategory($idCategory)
    // {
    //     $this->idCategory = $idCategory;
    // }

<?php
require  __DIR__ . "/../vendor/autoload.php";

namespace Source\Models;

use Source\Core\Model;

class ProductCategory extends Model
{
    private $id;
    private $name;

    public function __construct(int $id = null, String $name = null)
{
    $this->id = $id;
    $this->name = $name;
    $this->table = "products_categories";
 }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
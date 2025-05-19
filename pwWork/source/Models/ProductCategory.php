<?php
namespace Source\Models\Store;

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
}
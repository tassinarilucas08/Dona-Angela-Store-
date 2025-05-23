<?php
require  __DIR__ . "/../vendor/autoload.php";

namespace Source\Models\Products;

use Source\Core\Model;

public class Gender extends Model{
    protected $id;
    protected $desciption;
}

public function __construct(int $id = null, String $description = null)
{
    $this->id = $id;
    $this->description = $desciption
    $this->table = "genders";
}
<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Store\Product;

$products = new Product();
echo json_encode($products -> findAll());
<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Store\Product;

echo "Olá, products";

$get = $_GET;

var_dump($get["id"],$get["name"]);

$user = new User();
$user->findById($get["id"]);
var_dump($user);
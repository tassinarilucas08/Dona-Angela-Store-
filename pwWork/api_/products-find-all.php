<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Store\Product;

echo json_encode(findAll());
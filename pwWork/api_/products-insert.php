<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Store\Product;

$message;

if(!isset($_GET["name"], $_GET["price"], $_GET['idCategory'])){
    $message = [
        "sucess" => false,
        "message" =>"Algum dos parametros nao foi preenchido"
    ];
    echo json_encode($message);
    exit;
};

$product = new Product(NULL, $_GET["name"], $_GET["price"], $_GET["idCategory"]);

if($product->insert()){
    echo "produto inserido com sucesso..";
}
else{
    echo "erro ao inserir" . $product->getErrorMessage();
};

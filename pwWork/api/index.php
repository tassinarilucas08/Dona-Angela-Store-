<?php

ob_start();

require  __DIR__ . "/../vendor/autoload.php";

// os headers abaixo são necessários para permitir o acesso a API por clientes externos ao domínio
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Credentials: true'); // Permitir credenciais

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

use CoffeeCode\Router\Router;

$route = new Router("http://localhost/Dona-Angela-Store-/pwWork/api",":");

$route->namespace("Source\WebService");

// Users
$route->group("/Users");
$route->get("/", "Users:listUsers");
$route->get("/id/{id}", "Users:listUserById");
$route->get("/id/", "Users:listUserById");
$route->post("/add", "Users:createUser");
$route->put("/update", "Users:updateUser");

$route->dispatch();
$route->group("null");

//Genders

$route->group("/Genders");
$route->get("/", "Genders:listGenders");
$route->get("/id/{id}", "Genders:listGenderById"); // Se você tiver essa função
$route->get("/id/", "Genders:listGenderById");

$route->dispatch();
$route->group("null");

/** ERROR REDIRECT */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "code" => 404,
        "status" => "not_found",
        "message" => "URL não encontrada"
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

}

ob_end_flush();
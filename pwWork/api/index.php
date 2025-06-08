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
$route->post("/login", "Users:login");
$route->get("/", "Users:listUsers");
$route->get("/id/{id}", "Users:listUserById");
$route->post("/add", "Users:createUser");
$route->put("/update", "Users:updateUser");
$route->delete("/delete/id/{id}", "Users:deleteUser");

$route->group("null");

//Genders

$route->group("/Genders");
$route->get("/", "Genders:listGenders");
$route->get("/id/{id}", "Genders:listGenderById");
$route->post("/add", "Genders:createGender");
$route->put("/update", "Genders:updateGender");
$route->delete("/delete/id/{id}", "Genders:deleteGender");

$route->group("null");

//Questions

// $route->group("/Questions");
// $route->get("/", "Questions:listQuestions");
// $route->get("/id/{id}", "Questions:listQuestionById");
// $route->post("/add", "Question:createQuestion");
// $route->put("/update", "Question:updateQuestion");
// $route->delete("/delete/id/{id}", "Question:deleteQuestion");

// $route->group("null");

//Address

$route->group("/Addresses");
$route->get("/", "Addresses:listAddresses");
$route->get("/id/{id}", "Addresses:listAddressById");
$route->post("/add", "Addresses:createAddress");
$route->put("/update", "Addresses:updateAddress");
$route->delete("/delete/id/{id}", "Addresses:deleteAddress");

$route->group("null");

$route->dispatch();

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
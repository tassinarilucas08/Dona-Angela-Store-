<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

ob_start();

$route = new Router("http://localhost/Dona-Angela-Store-", ":");

$route->namespace("Source\Web");
// Rotas amigáveis da área pública
$route->get("/", "Site:home");
$route->get("/sobre", "Site:about");
$route->get("/contato", "Site:contact");
$route->get("/localizacao", "Site:location");
$route->get("/carrinho","Site:cart");
$route->get("/servicos","Site:services");
$route->get("/faqs","Site:faqs");
$route->get("/login","Site:login");
$route->get("/cadastro","Site:register");
$route->get("/perfil","Site:profile");
$route->get("/redefinir-senha","Site:reset_password");
$route->get("/redefinir-senha-telefone","Site:reset_password_phone");
$route->get("/produto","Site:product");
$route->get("/cadastro-vendedor","Site:seller_register");
$route->get("/nova-senha","Site:new_password");


// Rotas amigáveis da área restrita
$route->group("/app");
$route->get("/", "App:home");
$route->get("/sobre", "App:about");
$route->get("/contato", "App:contact");
$route->get("/localizacao", "App:location");
$route->get("/carrinho","App:cart");
$route->get("/servicos","App:services");
$route->get("/faqs","App:faqs");
$route->get("/perfil","App:profile");
$route->get("/produto","App:product");

// Rotas amigáveis do vendedor
$route->group("/seller");
$route->get("/", "Seller:home");
$route->get("/sobre", "Seller:about");
$route->get("/contato", "Seller:contact");
$route->get("/localizacao", "Seller:location");
$route->get("/carrinho","Seller:cart");
$route->get("/servicos","Seller:services");
$route->get("/faqs","Seller:faqs");
$route->get("/login","Seller:login");
$route->get("/cadastro","Seller:register");
$route->get("/perfil","Seller:profile");
$route->get("/redefinir-senha","Seller:reset_password");
$route->get("/redefinir-senha-telefone","Seller:reset_password_phone");
$route->get("/produto","Seller:product");
$route->get("/vendedor","Seller:seller");

$route->group(null);

$route->group("/admin");
$route->get("/", "Admin:home");
$route->get("/sobre", "Admin:about");
$route->get("/contato", "Admin:contact");
$route->get("/localizacao", "Admin:location");
$route->get("/carrinho","Admin:cart");
$route->get("/servicos","Admin:services");
$route->get("/faqs","Admin:faqs");
$route->get("/login","Admin:login");
$route->get("/cadastro","Admin:register");
$route->get("/perfil","Admin:profile");
$route->get("/redefinir-senha","Admin:reset_password");
$route->get("/redefinir-senha-telefone","Admin:reset_password_phone");
$route->get("/produto","Admin:product");
$route->get("/administrador","Admin:adm");
$route->get("/vendedor","Admin:seller");

$route->group(null);

$route->get("/ops/{errcode}", "Site:error");

$route->group(null);

$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
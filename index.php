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
$route->get("/carrinho-compras","Site:cart");
$route->get("/servicos","Site:services");
$route->get("/faqs","Site:faqs");
$route->get("/login","Site:login");
$route->get("/cadastro","Site:register");
$route->get("/perfil","Site:profile");
$route->get("/redefinir-senha","Site:reset_password");
$route->get("/redefinir-senha-telefone","Site:reset_password_phone");
$route->get("/produto","Site:product");

// Rotas amigáveis da área restrita
$route->group("/app");
$route->get("/", "App:home");
$route->get("/sobre", "App:about");
$route->get("/contato", "App:contact");
$route->get("/localizacao", "App:location");
$route->get("/carrinho-compras","App:cart");
$route->get("/servicos","App:services");
$route->get("/faqs","App:faqs");
$route->get("/login","App:login");
$route->get("/cadastro","App:register");
$route->get("/perfil","App:profile");
$route->get("/redefinir-senha","App:reset_password");
$route->get("/redefinir-senha-telefone","App:reset_password_phone");
$route->get("/produto","App:product");
$route->get("/vendedor","App:seller");

$route->group(null);

$route->group("/admin");
$route->get("/", "Admin:home");
$route->get("/sobre", "Admin:about");
$route->get("/contato", "Admin:contact");
$route->get("/localizacao", "Admin:location");
$route->get("/carrinho-compras","Admin:cart");
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
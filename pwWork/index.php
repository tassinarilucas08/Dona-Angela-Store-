<?php

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

ob_start();

$route = new Router("localhost/Dona-Angela-Store-/pwWork/", ":");

$route->namespace("Source\App");

$route->group(null);

$route->get("/", "Web:home");
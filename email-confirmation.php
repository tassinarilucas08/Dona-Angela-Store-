<?php
require __DIR__ . '/vendor/autoload.php';

use Source\WebService\Users;

// Recebe o token da URL
$token = $_GET['token'] ?? null;
if (!$token) {
    die("Token não fornecido");
}

$usersController = new Users();
$usersController->confirmEmail(); // Atualiza isConfirmed e confirmationToken no DB

// Mostra uma mensagem amigável
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Email confirmado!</title>
</head>
<body>
    <h1>E-mail confirmado com sucesso!</h1>
    <p>Agora você pode <a href="http://localhost/Dona-Angela-Store-/login">fazer login</a>.</p>
</body>
</html>

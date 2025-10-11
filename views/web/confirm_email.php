<?php
  $this->layout("_theme",[
    "title" => "Confirmação de email"
  ]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vendedor</title>
    <link rel="stylesheet" href="<?= url("/assets/web/css/confirm_email.css") ?>">
    <script src="<?= url("/assets/web/js/confirm_email.js") ?>" defer></script>
</head>
<body>
    <div class="aguarde-wrapper">
        <h1 class="titulo">Aguardando confirmação</h1>

        <div class="mensagem">
            <p>Enviamos um e-mail de confirmação para o endereço cadastrado.<br>
            Por favor, verifique sua caixa de entrada. Você tem 10 minutos para confirmar. Se passar esse tempo, registre-se novamente</p>
        </div>

        <div class="loader">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
  </div>
    
</body>
</html>
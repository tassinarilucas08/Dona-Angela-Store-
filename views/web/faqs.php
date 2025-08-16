<?php
$this->layout("_theme", [
  "title" => "faqs"
]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Angela Revendedora</title>
  <link rel="stylesheet" href="<?= url("/assets/web/css/faqs.css") ?>" />
  <script src="<?= url("/assets/web/js/faqs.js") ?>" defer></script>
</head>
<body>
    <div id="cabecalho-faq">
        <button type="submit" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
    </div>
    <div class="container">
        <h1>Envie sua Dúvida</h1>
        <p>Se você não encontrou o que procurava nas perguntas frequentes, envie sua dúvida usando o formulário abaixo. Responderemos o mais rápido possível!</p>

        <form action="enviar_duvida.php" method="POST">
            <label for="nome">Seu Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Seu Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="duvida">Sua Dúvida:</label>
            <textarea id="duvida" name="duvida" rows="6" required></textarea>

            <button type="submit">Enviar Dúvida</button>
        </form>
    </div>

</body>
</html>
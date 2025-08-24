<?php
 $this->layout("_theme",[
    "title" => "Redefinição de senha"
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= url("/assets/web/css/reset_password.css") ?>">
    <script src="<?= url("/assets/web/js/reset_password.js") ?>" async></script>
</head>
<body>
    <div class="container">
        <div class="redefinir-container">
            <div class="topo-redefinir">
                <button class="btn-voltar" onclick="window.history.back()">← Voltar</button>
            </div>
            <h2>Redefinir Senha</h2>
            <p>Informe seu e-mail para receber um link de redefinição.</p>

            <form>
                <div class="form-group">
                <label for="email">E-mail cadastrado</label>
                <input type="email" id="email" placeholder="exemplo@email.com" required>
                </div>
                <button id="enviar-link" type="submit">Enviar Link</button>
            </form>

            <div class="link-outro-modo">
                <a href="/Dona-Angela-Store-/redefinir-senha-telefone">Redefinir por telefone</a>
            </div>
        </div>

        <div class="image-container">
            <img src="/Dona-Angela-Store-/images/perfums/ekos_hidra.jpg" alt="Perfume Ilustrativo">
        </div>
    </div>
</body>
</html>
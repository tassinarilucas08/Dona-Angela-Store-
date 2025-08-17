<?php
 $this->layout("_theme",[
    "title" => "Cadastro"
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= url("/assets/web/css/register.css") ?>">
  <script src="<?= url("/assets/web/js/register.js") ?>" defer></script>
</head>
<body>
    <div class="container">
        <div class="voltar-wrapper">
            <button type="submit" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
        </div>

        <div class="image-container">
            <img src="/Dona-Angela-Store-/images/perfums/zaad.jpeg" alt="Imagem de Produto">
        </div>

        <div class="form-container">
            <h2>Cadastre-se</h2>
            <form method="POST" id = "registerForm">
                <label for="nome">Nome Completo</label>
                <input type="text" id="name" name="nome" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="telefone">Telefone - XX XXXXX-XXXX</label>
                <input type="tel" id="phone" name="telefone" required>

                <label for="senha">Senha</label>
                <input type="password" id="password" name="senha" required>

                <label for="senhaConfirmar">Confirmar Senha</label>
                <input type="password" id="password_confirm" name="senhaConfirmar" required>

                <div class="terms">
                    <p>Leia nossos <a href="/Dona-Angela-Store-/pdfs/termos_e_condicoes.pdf" target="_blank">Termos e Condições</a></p>
                </div>
                
                <div class="terms">
                    <input type="checkbox" name="termos" id="terms" required>
                    <label for="termos">Aceito os Termos e Condições</label>
                </div>          

                <button type="submit" id="register">Cadastrar</button>
            </form>
            
            <div class="link-login">
                Já tem uma conta? <a href="/Dona-Angela-Store-/login">Faça login</a>
            </div>
        </div>
    </div>
</body>
</html>
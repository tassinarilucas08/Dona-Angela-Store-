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
    <link rel="stylesheet" href="<?= url("/assets/app/css/register.css") ?>">
  <script src="<?= url("/assets/app/js/register.js") ?>" async></script>
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
            <form action="/cadastrar" method="POST">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>

                <label for="senhaConfirmar">Confirmar Senha</label>
                <input type="password" id="senhaConfirmar" name="senhaConfirmar" required>

                <div class="terms">
                    <p>Leia nossos <a href="/Dona-Angela-Store-/pdfs/termos_e_condicoes.pdf" target="_blank">Termos e Condições</a></p>
                </div>
                
                <div class="terms">
                    <input type="checkbox" name="termos" id="termos" required>
                    <label for="termos">Aceito os Termos e Condições</label>
                </div>          

            </form>
            <button type="submit" id="register">Cadastrar</button>
            <div class="link-login">
                Já tem uma conta? <a href="/Dona-Angela-Store-/app/login">Faça login</a>
            </div>
        </div>
    </div>
</body>
</html>
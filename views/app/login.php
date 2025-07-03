<?php
 $this->layout("_theme",[
    "title" => "Login"
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= url("/assets/app/css/login.css") ?>">
    <script src="<?= url("/assets/app/js/login.js") ?>" async></script>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="topo-login">
                <button type="submit" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
            </div>
            <h2>Login</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" required>
                </div>
                <button type="submit" id="login">Entrar</button>
                <div class="link-reset">
                    <a href="/Dona-Angela-Store-/app/redefinir-senha">Esqueci minha senha</a>
                </div>
            </form>
            <div class="link-register">
                Não tem uma conta? <a href="/Dona-Angela-Store-/app/cadastro">Cadastre-se</a>
            </div>
        </div>

        <div class="image-container">
            <img src="/Dona-Angela-Store-/images/perfums/biografia.jpg" alt="Imagem de Produto">
        </div>
    </div>
</body>
</html>
<?php
 $this->layout("_theme",[
    "title" => "Cadastro"
]);
?>

    <style>
    body {
        margin: 0;
        padding-top: 15px;
        padding-bottom: 20px;
        background-color: #f2f2f2; /* fundo amarelo queimado suave */
        font-family: 'Arial', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 93vh;
    }

    .container {
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        width: 1300px;
        background-color: #f2f2f2; /* leve transparência */
        padding: 40px 30px 30px 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .voltar-wrapper {
        position: absolute;
        top: 20px;
        left: 30px;
    }

    .btn-voltar {
        margin-top: 40px;
        margin-left: 120px;
        padding: 8px 14px;
        background-color: #d04c92;
        color: white;
        font-size: 14px;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btn-voltar:hover {
        background-color: #b3387c;
    }


    .image-container {
        flex: 1;
        max-width: 500px;
        padding-right: 30px;
    }
    .image-container img {
        width: 100%;
        border-radius: 10px;
        margin-top: 90px;
    }

    .form-container {
        flex: 1;
        max-width: 500px;
        padding-left: 30px;
    }

    h2 {
        text-align: center;
        color: #d04c92;
        margin-bottom: 15px;
    }

    label {
        font-size: 14px;
        color: #444;
        font-weight: bold;
        margin-top: 15px;
        display: block;
    }

    input {
        width: 100%;
        border: none;
        border-bottom: 2px solid #ccc;
        background-color: transparent;
        padding: 10px 5px;
        font-size: 16px;
        margin-bottom: 10px;
        transition: border-color 0.3s;
    }

    input:focus {
        outline: none;
        border-bottom: 2px solid #d04c92;
    }

    #register {
        background-color: #d04c92;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
        padding: 12px;
        border-radius: 8px;
        margin-top: 10px;
        width: 100%;
    }

    #register:hover {
        background-color: #b3387c;
    }

    .link-login {
        margin-top: 15px;
        font-size: 14px;
        text-align: center;
    }

    .link-login a {
        color: #d63384;
        text-decoration: none;
        font-weight: bold;
    }

    .link-login a:hover {
        text-decoration: underline;
    }

    .terms {
        font-size: 14px;
        color: #555;
        display: flex;
        align-items: center;
        margin-left: 0;
        padding: 0;
        border: 0;
    }

    .terms input[type="checkbox"] {
        width: auto;
        padding: 0;
        margin: 5px;
        margin-left: 0;
        border: 0;
    }

    .terms label {
        line-height: 1.5;
        margin: 0;
    }

    @media (max-width: 768px) {
        .container {
        flex-direction: column;
        padding: 20px;
        }

        .image-container,
        .form-container {
        max-width: 100%;
        padding: 0;
        }
    }
    </style>

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
                Já tem uma conta? <a href="/Dona-Angela-Store-/login">Faça login</a>
            </div>
        </div>
    </div>

    <script>
        let register = document.querySelector("#register");

        register.addEventListener('click', ()=>{
            window.location.href = "/Dona-Angela-Store-/";
        })
    </script>
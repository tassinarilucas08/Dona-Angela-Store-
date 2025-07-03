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
    <link rel="stylesheet" href="<?= url("/assets/admin/css/reset_password_phone.css") ?>">
</head>
<body>
    <div class="container">
        <div class="redefinir-container">
            <div class="topo-redefinir">
                <button class="btn-voltar" onclick="window.history.back()">← Voltar</button>
            </div>
            <h2>Redefinir por Telefone</h2>
            <p>Informe seu telefone para receber um código de redefinição.</p>

            <form>
                <div class="form-group">
                    <label for="telefone">Telefone cadastrado</label>
                    <input type="tel" id="telefone" placeholder="(51) 91234-5678" required>
                </div>
                <button type="submit">Enviar Código</button>
            </form>
        </div>

        <div class="image-container">
            <img src="/Dona-Angela-Store-/images/perfums/ekos_hidra.jpg" alt="Perfume Ilustrativo">
        </div>
    </div>
</body>
</html>
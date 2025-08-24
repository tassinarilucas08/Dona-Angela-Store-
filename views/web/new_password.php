<?php
  $this->layout("_theme",[
    "title" => "Nova Senha"
  ]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nova Senha</title>
  <link rel="stylesheet" href="<?= url("/assets/web/css/new_password.css") ?>">
  <script src="<?= url("/assets/web/js/new_password.js") ?>" async></script>
</head>
<body>
  <div class="container">
    <div class="reset-box">
      <button type="button" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
      <h2>Defina sua nova senha</h2>
      <p>Digite abaixo a sua nova senha de acesso e confirme para prosseguir.</p>
      
      <form method="POST" id="resetForm">
        <div class="form-group">
          <label for="password">Nova Senha</label>
          <input type="password" id="password" name="password" placeholder="Digite sua nova senha" required>
        </div>
        <div class="form-group">
          <label for="confirm-password">Confirmar Nova Senha</label>
          <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirme sua nova senha" required>
        </div>
        
        <button type="submit" class="btn-primary">Redefinir Senha</button>
      </form>
    </div>

    <div class="image-container">
      <img src="/Dona-Angela-Store-/images/perfums/ekos_hidra.jpg" alt="Imagem ilustrativa">
    </div>
  </div>
</body>
</html>
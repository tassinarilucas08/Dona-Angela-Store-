<?php
  $this->layout("_theme",[
    "title" => "Cadastro de Vendedor"
  ]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro de Vendedor</title>
  <link rel="stylesheet" href="<?= url("/assets/web/css/seller_register.css") ?>">
  <script src="<?= url("/assets/web/js/seller_register.js") ?>" defer></script>
</head>
<body>
  <header class="cabecalho-compras">
    <button type="button" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
    <h1>Cadastro de Vendedor</h1>
  </header>

  <main class="vendor-wrapper">
    <section class="pitch">
      <h2>Venda com a Dona Angela Store</h2>
      <p>
        Crie seu catálogo, organize seus produtos e receba pedidos com praticidade.
        Cadastre-se ao lado e em poucos minutos sua loja estará pronta para encantar clientes ✨
      </p>
      <ul class="benefits">
        <li>✔ Página da sua loja com sua marca</li>
        <li>✔ Catálogo simples e rápido de gerenciar</li>
        <li>✔ Receba pedidos por WhatsApp</li>
        <li>✔ Sem complicação: tudo no navegador</li>
      </ul>
    </section>

    <section class="form-card">
      <h3>Dados do Vendedor</h3>

      <form method="POST" id="vendorRegisterForm" novalidate>
        <div class="grid">

          <div class="field">
            <label for="ownerName">Nome</label>
            <input type="text" id="ownerName" name="ownerName" placeholder="Ex.: Angela Santos" required>
          </div>

          <div class="field">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="voce@exemplo.com" required>
          </div>

          <div class="field">
            <label for="phone">Telefone / WhatsApp</label>
            <input type="tel" id="phone" name="phone" placeholder="(00) 90000-0000" required>
          </div>

          <div class="field">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Mín. 6 caracteres" required>
          </div>

          <div class="field">
            <label for="password_confirm">Confirmar Senha</label>
            <input type="password" id="password_confirm" name="password_confirm" required>
          </div>
        </div>

        <div class="terms">
          <input type="checkbox" id="terms" required>
          <label for="terms">Li e aceito os <a href="<?= url('/pdfs/termos_e_condicoes.pdf') ?>" target="_blank">Termos e Condições</a>.</label>
        </div>

        <div class="actions">
          <button type="submit" class="btn-register">Começar a vender</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
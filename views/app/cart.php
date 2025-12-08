<?php
 $this->layout("_theme",[
    "title" => "Carrinho"
]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrinho</title>
  <script src="<?= url("/assets/app/js/cart.js") ?>" defer></script>
  <link rel="stylesheet" href="<?= url("/assets/app/css/cart.css") ?>">
</head>
<body>
    <header class="cabecalho-compras">
        <button type="submit" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
        <h1>Seu Carrinho</h1>
    </header>

  <main class="container">
  <section class="cart-items" id="cart-items">
  <!-- Itens do carrinho serão inseridos via JS -->
</section>

<section class="resumo">
  <h2>Resumo da Compra</h2>
  <p>Total: <strong id="cart-total">R$ 0,00</strong></p>

  <h3>Selecione o Endereço</h3>
  <select>
    <option value="">Selecione...</option>
    <option value="casa">Rua das Flores, 123 - Centro</option>
    <option value="trabalho">Av. Brasil, 456 - Comercial</option>
  </select>

  <h3>Formas de Pagamento</h3>
  <ul>
    <li>Pix</li>
    <li>Dinheiro na Entrega</li>
    <li>Cartão de Crédito</li>
    <li>Cartão de Débito</li>
  </ul>

  <p class="observacao">
    Após escolher seus produtos, finalize o pedido diretamente com a Angela pelo WhatsApp.
  </p>

  <div class="whatsapp-container">
    <img src="https://img.icons8.com/color/24/000000/whatsapp--v1.png" alt="WhatsApp" />
    <a href="https://wa.me/5551997532447">WhatsApp</a>
  </div>
</section>
  </main>
</body>
</html>
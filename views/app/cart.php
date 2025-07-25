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
  <script src="<?= url("/assets/app/js/cart.js") ?>" async></script>
  <link rel="stylesheet" href="<?= url("/assets/app/css/cart.css") ?>">
</head>
<body>
    <header class="cabecalho-compras">
        <button type="submit" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
        <h1>Seu Carrinho</h1>
    </header>

  <main class="container">
    <section class="cart-items">
      <a href="/Dona-Angela-Store-/app/produto">
        <div class="item">
          <img src="/Dona-Angela-Store-/images/perfums/lily.jpg" alt="Lily">
          <div class="info">
            <h3>Lily</h3>
            <p>R$ 89,90</p>
          </div>
        </div>
      </a>
      <div class="item">
        <img src="/Dona-Angela-Store-/images/perfums/essencial.jpg" alt="Essencial">
        <div class="info">
          <h3>Essencial</h3>
          <p>R$ 59,90</p>
        </div>
      </div>
      <div class="item">
        <img src="/Dona-Angela-Store-/images/perfums/ekos_hidra.jpg" alt="Ekos">
        <div class="info">
          <h3>Ekos Hidratante</h3>
          <p>R$ 39,90</p>
        </div>
      </div>
    </section>

    <section class="resumo">
      <h2>Resumo da Compra</h2>
      <p>Total: <strong>R$ 189,70</strong></p>

      <h3>Selecione o Endereço</h3>
      <select>
        <option value="">Selecione...</option>
        <option value="casa">Rua das Flores, 123 - Centro</option>
        <option value="trabalho">Av. Brasil, 456 - Comercial</option>
        <option value="outro">Outro Endereço...</option>
      </select>

      <button id="btnEndereco">Novo Endereço</button>

      <!-- Modal de Endereço -->
      <div id="modalEndereco" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <input type="text" placeholder="Rua">
          <input type="text" placeholder="Número">
          <input type="text" placeholder="Complemento">
          <input type="text" placeholder="Cidade">
          <input type="text" placeholder="Estado">
          <input type="text" placeholder="CEP">
          <button>Confirmar Endereço</button>
        </div>
      </div>

      <h3>Formas de Pagamento</h3>
      <ul>
        <li>Pix</li>
        <li>Dinheiro na Entrega</li>
        <li>Cartão de Crédito</li>
        <li>Cartão de Débito</li>
      </ul>

      <p class="observacao">Após escolher seus produtos, finalize o pedido diretamente com a Angela pelo WhatsApp.</p>

      <div class="whatsapp-container">
        <img src="https://img.icons8.com/color/24/000000/whatsapp--v1.png" alt="WhatsApp" />
        <a href="https://wa.me/5551997532447">WhatsApp</a>
      </div>
    </section>
  </main>
</body>
</html>
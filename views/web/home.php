<?php
$this->layout("_theme", [
  "title" => "Loja de Beleza"
]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Angela Revendedora</title>
  <link rel="stylesheet" href="<?= url("/assets/web/css/home.css") ?>" />
  <script src="<?= url("/assets/web/js/home.js") ?>" defer></script>
</head>
<body>
  <div class="logo">
    <h1>Angela Revendedora</h1>
  </div>

  <header>
    <div class="tooltip-container" id="mother-informations">
      <img src="/Dona-Angela-Store-/images/mother/image_mother.png" alt="Foto da Mãe">
      <div class="mother-informations">
        <div class="name">Angela</div>
        <p class="mother-informations-colorP">saiba mais sobre mim aqui!</p>
      </div>
    </div>

    <div class="search-box">
      <input type="text" placeholder="Pesquisar produtos...">
      <img src="/Dona-Angela-Store-/images/layout/lupa.png" alt="Buscar">
    </div>

    <a href="/Dona-Angela-Store-/sobre" class="sobre-link">
      <img src="/Dona-Angela-Store-/images/layout/sobre.png" alt="Sobre">Sobre
    </a>

    <a href="/Dona-Angela-Store-/login" class="login-link" id="btnLogin">Entrar</a>

    <div class="cart-icon">
      <a href="/Dona-Angela-Store-/login">
        <img src="/Dona-Angela-Store-/images/layout/sacola.png" alt="Sacola de Compras">
      </a>
      <span class="cart-badge">0</span>
    </div>
  </header>

  <!-- Filtros -->
  <section class="product-categories">
    <div class="category-buttons">
      <button class="movButton" id="all" onclick="handleClick(this, 'todos')"><b>Todos</b></button>
      <button class="movButton" id="male" onclick="handleClick(this, 'masculino')"><b>Masculino</b></button>
      <button class="movButton" id="female" onclick="handleClick(this, 'feminino')"><b>Feminino</b></button>
      <button class="movButton" id="infant" onclick="handleClick(this, 'infantil')"><b>Infantil</b></button>
    </div>
  </section>

  <!-- Promoção -->
  <section class="promo-section-card">
    <div class="promo-card">
      <h2>Promoções Ativas</h2>
      <p>Ofertas incríveis por tempo limitado!</p>
      <button onclick="filterProducts('promocao')">Confira Agora</button>
    </div>
  </section>

  <!-- Container de produtos vazio -->
  <main>
    <section class="products-container" id="products"></section>
  </main>
</body>
</html>
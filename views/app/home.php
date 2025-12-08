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
  <link rel="stylesheet" href="<?= url("/assets/app/css/home.css") ?>" />
  <script src="<?= url("/assets/app/js/home.js") ?>" defer></script>
</head>
<body>
  <!-- Modal -->
  <div id="modal" class="modal-overlay" onmouseenter="cancelHideModal()" onmouseleave="hideModal()">
    <div class="modal-content">
      <img src="/Dona-Angela-Store-/images/perfums/zaad.jpeg" alt="Foto da Mãe" class="bg">
      <div class="modal-text">
        <h2>A História da Angela</h2>
        <p>
          Uma mulher de força extraordinária, que com amor e dedicação construiu mais do que uma família — construiu valores.
          Desde jovem, enfrentou desafios com coragem, ensinando pelo exemplo e inspirando todos à sua volta. Esta loja é um
          reflexo da sua beleza interior, da sua sensibilidade e da sua visão de futuro.
        </p>
      </div>
    </div>
  </div>

  <div class="logo">
    <h1>Angela Revendedora</h1>
  </div>

  <!-- Cabeçalho -->
  <header>
    <div class="tooltip-container" id="mother-informations">
      <img src="/Dona-Angela-Store-/images/mother/image_mother.png" alt="Foto da Mãe" onmouseenter="showModal()" onmouseleave="startHideModal()">
      <div class="mother-informations">
        <div class="name">Angela</div>
        <p class="mother-informations-colorP">saiba mais sobre mim aqui!</p>
      </div>
    </div>

    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Pesquisar produtos...">
      <img src="/Dona-Angela-Store-/images/layout/lupa.png" alt="Buscar">
    </div>

    <a href="/Dona-Angela-Store-/app/sobre" class="sobre-link">
      <img src="/Dona-Angela-Store-/images/layout/sobre.png" alt="Sobre">
      Sobre
    </a>

    <span id="nomeUsuario" style="margin-right: 10px;"></span>

    <a class="logout-link" id="btnLogout">sair</a>

    <a href="/Dona-Angela-Store-/app/perfil" class="perfil-link" id="btnPerfil" > 
      <img src="https://img.icons8.com/ios-filled/50/000000/user-male-circle.png" alt="Perfil do Usuário" class="perfil-icon">
    </a>

    <div class="cart-icon">
      <a href="/Dona-Angela-Store-/app/carrinho">
        <img src="/Dona-Angela-Store-/images/layout/sacola.png" alt="Sacola de Compras">
      </a>
      <span class="cart-badge">3</span>
    </div>
  </header>

  <!-- Filtros -->
  <section class="product-categories">
    <div class="category-buttons">
      <button class="movButton" id="all" onclick="handleClick(this, 'todos')""><b>Todos</b></button>
      <button class="movButton"id="male" onclick="handleClick(this, 'masculino')"><b>Masculino</b></button>
      <button class="movButton" id="female" onclick="handleClick(this, 'feminino')"><b>Feminino</b></button>
      <button class="movButton" id="infant" onclick="handleClick(this, 'infantil')"><b>Infantil</b></button>
    </div>
  </section>

  <!-- Promoção -->
  <main>
    <section class="promo-section-card">
      <div class="promo-card">
        <h2>Promoções Ativas</h2>
        <p>Ofertas incríveis por tempo limitado!</p>
        <button onclick="filterProducts('promocao')">Confira Agora</button>
      </div>
    </section>

    <section class="products-container" id="products">

    </section>
  </main>
</body>
</html>
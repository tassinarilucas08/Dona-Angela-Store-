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
      <input type="text" placeholder="Pesquisar produtos...">
      <img src="/Dona-Angela-Store-/images/layout/lupa.png" alt="Buscar">
    </div>

    <span id="nomeUsuario" style="margin-right: 10px;"></span>

    <a href="/Dona-Angela-Store-/login" class="login-link" id="btnLogin">Entrar</a>

    <a href="/Dona-Angela-Store-/perfil" class="perfil-link" id="btnPerfil" style="display: none;">
      <img src="https://img.icons8.com/ios-filled/50/000000/user-male-circle.png" alt="Perfil do Usuário" class="perfil-icon">
    </a>

    <button id="logoutBtn" style="display: none; margin-left: 10px;">Sair</button>

    <div class="cart-icon">
      <a href="/Dona-Angela-Store-/carrinho">
        <img src="/Dona-Angela-Store-/images/layout/sacola.png" alt="Sacola de Compras">
      </a>
      <span class="cart-badge">3</span>
    </div>
  </header>

  <!-- Filtros -->
  <section class="product-categories">
    <div class="category-buttons">
      <button class="movButton" onclick="handleClick(this, 'todos')" style="background-color: gainsboro;"><b>Todos</b></button>
      <button class="movButton" onclick="handleClick(this, 'masculino')" style="background-color: lightblue;"><b>Masculino</b></button>
      <button class="movButton" onclick="handleClick(this, 'feminino')" style="background-color: lightpink;"><b>Feminino</b></button>
      <button class="movButton" onclick="handleClick(this, 'infantil')" style="background-color: lightgreen;"><b>Infantil</b></button>
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
      <!-- Produtos aqui -->
      <div class="product-card todos masculino perfumes">
        <span class="tag tag-natura">Natura</span>
        <img src="/Dona-Angela-Store-/images/perfums/essencial.jpg" alt="Produto Natura Essencial">
        <div class="product-info">
          <h2>Essencial</h2>
          <p>Perfume floral com toque cítrico</p>
          <div class="price"><span class="normal">R$ 89,90</span></div>
        </div>
      </div>

      <div class="product-card promocao todos feminino hidratantes">
        <span class="tag tag-natura">Natura</span>
        <img src="/Dona-Angela-Store-/images/perfums/ekos_hidra.jpg" alt="Produto Natura Ekos">
        <div class="product-info">
          <h2>Ekos</h2>
          <p>Creme hidratante para o corpo</p>
          <div class="price">
            <span class="old">R$ 49,90</span>
            <span class="new">R$ 39,90</span>
          </div>
        </div>
      </div>

      <a href="/Dona-Angela-Store-/produto">
        <div class="product-card todos feminino perfumes">
          <span class="tag tag-boticario">O Boticário</span>
          <img src="/Dona-Angela-Store-/images/perfums/lily.jpg" alt="Produto O Boticário Lily">
          <div class="product-info">
            <h2>Lily</h2>
            <p>Aroma floral sofisticado</p>
            <div class="price"><span class="normal">R$ 119,90</span></div>
          </div>
        </div>
      </a>
    </section>
  </main>
</body>
</html>
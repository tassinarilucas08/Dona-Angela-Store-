<?php
 $this->layout("_theme",[
    "title" => "Loja de Beleza"
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= url("/assets/admin/css/home.css") ?>">
  <script src="<?= url("/assets/admin/js/home.js") ?>" async></script>

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
          reflexo da sua beleza interior, da sua sensibilidade e da sua visão de futuro. Angela iniciou sua jornada como revendedora
          a mais de 10 anos. Nesse tempo conheceu muitos amigos e clientes que estão com ela a vários anos.
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
      <p class="mother-informations-colorP">saiba mais sobre mim aqui!</p></div><!-- Nome ao lado da imagem -->
    </div>
    
    <div class="search-box">
      <input type="text" placeholder="Pesquisar produtos...">
      <img src="/Dona-Angela-Store-/images/layout/lupa.png" alt="Buscar">
    </div>

    <a href="/Dona-Angela-Store-/admin/login" class="login-link">Login</a>

    <a href="/Dona-Angela-Store-/admin/perfil" class="perfil-link">
      <img src="https://img.icons8.com/ios-filled/50/000000/user-male-circle.png" alt="Perfil do Usuário" class="perfil-icon">
    </a>

    <div class="cart-icon">
      <a href="/Dona-Angela-Store-/admin/carrinho"><img src="/Dona-Angela-Store-/images/layout/sacola.png" alt="Sacola de Compras"></a>
      <span class="cart-badge">3</span>
    </div>
  </header>
  
<!-- Filtro por Categoria -->
<section class="product-categories">
  <div class="category-buttons">
    <button class="movButton" onclick="handleClick(this, 'todos')" style="background-color: gainsboro;"><b>Todos</b></button>
    <button class="movButton" onclick="handleClick(this, 'masculino')" style="background-color: lightblue;"><b>Masculino</b></button>
    <button class="movButton" onclick="handleClick(this, 'feminino')" style="background-color: lightpink;"><b>Feminino</b></button>
    <button class="movButton" onclick="handleClick(this, 'infaltil')" style="background-color: lightgreen;"><b>Infantil</b></button>   
  </div>
</section>

  <!-- Promoções do Dia -->
  <main>
    <section class="promo-section-card">
      <div class="promo-card">
        <h2>Promoções Ativas</h2>
        <p>Ofertas incríveis por tempo limitado!</p>
        <button onclick="filterProducts('promocao')">Confira Agora</button>
      </div>
    </section>      

<section class="product-categories">
  <div class="category-buttons">
<!-- Botão de exemplo -->
    <!-- <button class="movButton" id="female" onclick="filterProducts('feminino hidratantes')"><b>Maquiagem</b></button>
    <button class="movButton" id="male" onclick="filterProducts('feminino hidratantes')"><b>Barba</b></button> -->
  </div>
</section>

    <!-- Grade de produtos -->
    <section class="products-container" id="products">

      <!-- Produto Natura - Essencial -->
<div class="product-card todos masculino perfumes">
  <span class="tag tag-natura">Natura</span>
  <img src="/Dona-Angela-Store-/images/perfums/essencial.jpg" alt="Produto Natura Essencial">
  <div class="product-info">
    <h2>Essencial</h2>
    <p>Perfume floral com toque cítrico</p>
    <div class="price">
      <span class="normal">R$ 89,90</span>
    </div>
  </div>
</div>

<!-- Produto Natura - Ekos -->
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

<!-- Produto O Boticário - Lily -->
<a href="/Dona-Angela-Store-/admin/produto"><div class="product-card todos feminino perfumes">
  <span class="tag tag-boticario">O Boticário</span>
  <img src="/Dona-Angela-Store-/images/perfums/lily.jpg" alt="Produto O Boticário Lily">
  <div class="product-info">
    <h2>Lily</h2>
    <p>Aroma floral sofisticado</p>
    <div class="price">
      <span class="normal">R$ 119,90</span>
    </div>
  </div>
</div></a>
    </section>

    <<div class="admin-actions">
      <a href="/Dona-Angela-Store-/admin/vendedor" class="action-button">+ Criar Produto</a>
      <a href="/Dona-Angela-Store-/admin/administrador" class="action-button">+ Criar Cliente</a>
    </div>
  </main>
</body>
</html>
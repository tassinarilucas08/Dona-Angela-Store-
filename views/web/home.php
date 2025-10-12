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

    <a href="/Dona-Angela-Store-/sobre" class="sobre-link">
      <img src="/Dona-Angela-Store-/images/layout/sobre.png" alt="Sobre">
      Sobre
    </a>

    <a href="/Dona-Angela-Store-/login" class="login-link" id="btnLogin">Entrar</a>

    <div class="cart-icon">
      <a href="/Dona-Angela-Store-/login">
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
  <?php foreach($productsData as $product): ?>
    <?php
        // Dados básicos do produto
        $id          = $product->id ?? 0;
        $name        = $product->name ?? "Produto sem nome";
        $description = $product->description ?? "Descrição não disponível";
        $price       = isset($product->price) ? number_format($product->price, 2, ",", ".") : "0,00";
        $salePrice   = isset($product->sale_price) ? number_format($product->sale_price, 2, ",", ".") : null;

        // Brand, categoria e gênero
        $brand       = isset($product->brand) ? $product->brand : "Marca";
        $category    = isset($product->category) ? strtolower($product->category) : "outros";
        $gender      = isset($product->gender) ? strtolower($product->gender) : "unissex";

        // Foto: pegar primeira se existir, senão fallback
        if(isset($product->photos) && is_array($product->photos) && count($product->photos) > 0) {
            $photo = $product->photos[0];
        } else {
            $photo = "/Dona-Angela-Store-/images/default.png";
        }
    ?>

    <div class="product-card todos <?= $gender ?> <?= $category ?>">
        <span class="tag tag-<?= strtolower($brand) ?>"><?= $brand ?></span>
        <img src="<?= $photo ?>" alt="Produto <?= $name ?>">
        <div class="product-info">
            <h2><?= $name ?></h2>
            <p><?= $description ?></p>
            <div class="price">
                <?php if($salePrice): ?>
                    <span class="old">R$ <?= $price ?></span>
                    <span class="new">R$ <?= $salePrice ?></span>
                <?php else: ?>
                    <span class="normal">R$ <?= $price ?></span>
                <?php endif; ?>
            </div>
            <a href="/Dona-Angela-Store-/product/<?= $id ?>" class="btn-view">Ver Produto</a>
        </div>
    </div>
<?php endforeach; ?>
</section>

  </main>
</body>
</html>
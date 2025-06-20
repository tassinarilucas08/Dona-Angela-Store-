<?php
 $this->layout("_theme",[
    "title" => "Loja de Beleza"
]);
?>

  <style>
    /* Reset básico */
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    /* Estilos Gerais */
    body {
    font-family: Arial, sans-serif;
    background-color: #f9fafb;
    color: #333;
    background-color: #f2f2f2;
    }

    /* Cabeçalho */
    header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    background-color: #FFF8E1; /* amarelo queimado claro */
    padding: 12px 20px;
    gap: 16px;
    }


    .tooltip-container img {
    width: 96px;
    height: 96px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #ccc;
    cursor: pointer;
    }

    .search-box {
    flex: 1;
    margin: 0 24px;
    position: relative;
    }

    .search-box input {
    width: 100%;
    padding: 8px 32px 8px 12px;
    border: none;
    border-bottom: 1px solid #ccc;
    background: transparent;
    }

    .search-box img {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    }

    .login-link {
    margin-right: 16px;
    color: #d45c94;
    text-decoration: none;
    font-size: 14px;
    }

    .login-link:hover {
    text-decoration: underline;
    }

    .perfil-link {
    display: flex;
    align-items: center;
    margin-right: 12px;
    }

    .perfil-icon {
    width: 32px;
    height: 32px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #a62c7b;
    background-color: white;
    padding: 2px;
    cursor: pointer;
    transition: transform 0.2s ease;
    }

    .perfil-icon:hover {
    transform: scale(1.1);
    }

    .cart-icon {
    position: relative;
    }

    .cart-icon img {
    width: 24px;
    height: 24px;
    }

    .cart-badge {
    position: absolute;
    top: -6px;
    right: -6px;
    background: red;
    color: white;
    font-size: 10px;
    padding: 2px 5px;
    border-radius: 50%;
    }

    /* Modal */
    .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 50;
    }

    .modal-overlay.active {
    display: flex;
    }

    .modal-content {
    position: relative;
    width: 90%;
    max-width: 600px;
    height: 85vh;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 40px;
    overflow: auto;
    border-radius: 12px;
    }

    .modal-content img.bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.3;
    z-index: 0;
    }

    .modal-text {
    position: relative;
    z-index: 10;
    }

    /* Promoções com imagem de fundo */
    .promo-section-card {
    position: relative;
    height: 360px;
    background-image: url('/Dona-Angela-Store-/images/perfums/ekos_hidra.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    }

    .promo-card {
    background-color: rgba(255, 255, 255, 0.85);
    padding: 30px 50px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transform: translateY(-20px);
    transition: transform 0.3s ease;
    }

    .promo-card:hover {
    transform: translateY(-10px); /* Efeito ao passar o mouse */
    }

    .promo-card h2 {
    font-size: 28px;
    color: #111;
    margin-bottom: 10px;
    font-weight: bold;
    }

    .promo-card p {
    font-size: 18px;
    color: #555;
    }

    .promo-card button {
    padding: 12px 24px;
    background-color: #A62C7B; /* Rosa forte */
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 12px;
    transition: background-color 0.3s;
    }

    .promo-card button:hover {
    background-color: #9B2471; /* Tom mais escuro de rosa */
    }

    /* Grade de produtos */
    .products-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 24px;
    justify-content: center;
    }

    a {
    text-decoration: none;
    
    }

    a h2 {
    font-weight: bold;
    color: #323232
    }

    /* Produto com selo */
    .product-card {
    position: relative;
    background-color: white;
    padding: 16px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
    width: 260px;
    }

    .product-card:hover {
    transform: translateY(-4px);
    }

    .product-card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 6px;
    }

    .tag {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #555;
    color: white;
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
    }

    .tag-natura {
    background-color: #3B924E;
    }

    .tag-boticario {
    background-color: #A62C7B;
    }

    .product-info {
    margin-top: 8px;
    }

    .product-info h2 {
    font-size: 18px;
    font-weight: bold;
    }

    .product-info p {
    font-size: 14px;
    color: #555;
    }

    .price {
    margin-top: 4px;
    }

    .price .old {
    text-decoration: line-through;
    font-size: 14px;
    color: #999;
    }

    .price .new {
    color: #d32f2f;
    font-size: 20px;
    font-weight: bold;
    margin-left: 8px;
    }
    /* Título no topo como logo */
    .logo {
    background-color: #F8C9D4; /* Rosa suave */
    padding: 12px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
    }

    .logo h1 {
    font-size: 32px;
    font-weight: bold;
    color: #A62C7B;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin: 0;
    }
    .tooltip-container {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    transition: transform 0.3s ease;
    }

    .tooltip-container:hover {
    transform: scale(1.05); /* Dá um efeito de destaque ao passar o mouse */
    }

    .tooltip-container img {
    width: 96px;
    height: 96px;
    object-fit: cover;
    border-radius: 10px;
    border: 4px solid #A62C7B; /* Borda mais grossa e suave */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .tooltip-container .name{
    font-size: 18px;
    font-weight: bold;
    color: #A62C7B; /* Cor do nome em rosa */
    text-transform: uppercase;
    letter-spacing: 1px;
    }
    .mother-informations{
    display: flex;
    align-content: center;
    flex-direction: column;
    }
    .mother-informations-colorP{
    color: #A62C7B; /* Cor do nome em rosa */
    }
    .site-footer-compact {
    background-color: #fff8f0;
    padding: 2rem;
    font-family: sans-serif;
    border-top: 2px solid #f3dada;
    }

    .footer-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 2rem;
    }

    .footer-contact,
    .footer-faq {
    flex: 1;
    min-width: 250px;
    color: #d45c94;
    }

    .footer-contact h2,
    .footer-faq h2 {
    font-size: 1.4rem;
    margin-bottom: 1rem;
    }

    .footer-contact ul,
    .footer-faq ul {
    list-style: none;
    padding: 0;
    }

    .footer-contact li,
    .footer-faq li {
    margin-bottom: 0.6rem;
    display: flex;
    align-items: center;
    }

    .footer-contact img {
    margin-right: 0.5rem;
    }

    .footer-contact a {
    color: #d45c94;
    text-decoration: none;
    font-weight: bold;
    }

    .footer-contact a:hover {
    text-decoration: underline;
    }

    .horario {
    margin-top: 1rem;
    font-style: italic;
    color: #a04d7d;
    }
    .footer-faq li {
    margin-bottom: 1.5rem;
    }

    .footer-faq .pergunta {
    font-weight: bold;
    color: #a04d7d;
    margin-bottom: 0.3rem;
    }

    .footer-faq .resposta {
    margin-left: 1rem;
    color: #d45c94;
    line-height: 1.4;
    }

    .product-categories {
    text-align: center;
    margin: 30px 0;
    }

    .category-buttons button {
    margin: 5px;
    padding: 10px 20px;
    border: none;
    background-color: #f2f2f2;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    }

    .category-buttons button:hover {
    background-color: #d4d4d4;
    }
    .price .normal {
    color: rgba(13, 13, 13, 0.87);
    font-size: 20px;
    font-weight: bold;
    margin-left: 8px;
    margin-left: 0px;
    }
    .movButton#male{
    background-color: lightblue;
    }
    .movButton#female{
    background-color: lightpink;
    }
    .movButton {
    transition: transform 0.1s ease;
    cursor: pointer;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    }
    .movButton.clicked {
    transform: scale(0.9);
    }
  </style>

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

    <a href="/Dona-Angela-Store-/login" class="login-link">Login</a>

    <a href="/Dona-Angela-Store-/perfil" class="perfil-link">
      <img src="https://img.icons8.com/ios-filled/50/000000/user-male-circle.png" alt="Perfil do Usuário" class="perfil-icon">
    </a>

    <div class="cart-icon">
      <a href="/Dona-Angela-Store-/compras"><img src="/Dona-Angela-Store-/images/layout/sacola.png" alt="Sacola de Compras"></a>
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
<a href="/Dona-Angela-Store-/produto"><div class="product-card todos feminino perfumes">
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
  </main>

  <footer class="site-footer-compact">
    <div class="footer-container">
      
      <!-- Contatos -->
      <section class="footer-contact">
        <h2>📞 Fale Conosco</h2>
        <ul>
          <li>
            <img src="https://img.icons8.com/color/24/000000/whatsapp--v1.png" alt="WhatsApp" />
            <a href="https://wa.me/5551997532447">WhatsApp</a>
          </li>
          <li>
            <img src="https://img.icons8.com/color/24/000000/instagram-new--v1.png" alt="Instagram" />
            <a href="https://instagram.com/angela.revendedora">@angela.revendedora</a>
          </li>
          <li>
            <img src="https://img.icons8.com/color/24/000000/email.png" alt="E-mail" />
            <a href="mailto:angela.revendedora@email.com">angela.revendedora@email.com</a>
          </li>
          <li class="horario">🕐 Segunda a sábado, das 8h às 20h</li>
        </ul>
      </section>
  
      <!-- FAQ -->
<section class="footer-faq">
  <h2>❓ Dúvidas Frequentes</h2>
  <ul>
    <li>
      <p class="pergunta">🛒 Como faço um pedido?</p>
      <p class="resposta">Escolha seus produtos, adicione ao carrinho e finalize pelo WhatsApp. A Angela vai confirmar tudo com você!</p>
    </li>
    <li>
      <p class="pergunta">📦 Onde vocês entregam?</p>
      <p class="resposta">Entregamos na região de [sua cidade/bairro], com taxa acessível. Consulte no WhatsApp para mais detalhes.</p>
    </li>
    <li>
      <p class="pergunta">📍 Posso retirar em mãos?</p>
      <p class="resposta">Sim! Após o pedido, combinamos um horário certinho para retirada.</p>
    </li>
    <li>
      <p class="pergunta">✔️ Os produtos são originais?</p>
      <p class="resposta">Sim, todos os produtos são 100% originais da Natura e O Boticário, com garantia de procedência.</p>
    </li>
    <li>
      <p class="pergunta">🔎 Posso encomendar algo que não está no site?</p>
      <p class="resposta">Claro! É só chamar no WhatsApp que a gente verifica a disponibilidade para você.</p>
    </li>
  </ul>
</section>

    </div>
  </footer>
  
  <script>
    function scrollToProdutos() {
    const produtosSection = document.getElementById('products');
    produtosSection.scrollIntoView({ behavior: 'smooth' });
  }
  
    let hideTimeout;

    function showModal() {
      clearTimeout(hideTimeout);
      document.getElementById('modal').classList.add('active');
    }

    function startHideModal() {
      hideTimeout = setTimeout(() => {
        document.getElementById('modal').classList.remove('active');
      }, 150);
    }

    function hideModal() {
      document.getElementById('modal').classList.remove('active');
    }

    function cancelHideModal() {
      clearTimeout(hideTimeout);
    }

    let motherInformationsClick = document.querySelector("#mother-informations");
    motherInformationsClick.addEventListener('click', ()=>{
        showModal();
    });

    function filterProducts(category) {
  const products = document.querySelectorAll('.product-card');
  products.forEach(product => {
    if (category === 'all') {
      product.style.display = 'block';
    } else {
      product.style.display = product.classList.contains(category) ? 'block' : 'none';
    }
  });
  scrollToProdutos();
}
function handleClick(button, category) {
    // Adiciona classe de animação
    button.classList.add('clicked');

    // Remove a classe após a animação
    setTimeout(() => {
      button.classList.remove('clicked');
    }, 100);

    // Chama a função de filtro
    filterProducts(category);
  }
  </script>

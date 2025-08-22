<?php
 $this->layout("_theme",[
    "title" => "Sobre"
]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sobre</title>
  <link rel="stylesheet" href="<?= url("/assets/web/css/about.css") ?>">
</head>
<body>
  <header class="cabecalho-compras">
    <button type="button" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
    <h1>Sobre</h1>
  </header>

  <main class="sobre-container">
    <section class="texto-sobre">
      <h2>Bem-vindo à Dona Angela Store</h2>
      <p>
        A <strong>Dona Angela Store</strong> é mais do que um simples catálogo virtual. Foi criada com o objetivo de facilitar a experiência de compra dos nossos clientes, oferecendo uma navegação intuitiva, moderna e organizada.
      </p>
      <p>
        Aqui, você encontra uma vitrine digital com todos os nossos produtos, com visual limpo e categorização prática, para que você encontre rapidamente o que procura. Seja para uso pessoal, presente ou reposição de itens essenciais.
      </p>
      <p>
        O sistema foi pensado para ser simples e eficiente, ideal tanto para quem tem familiaridade com tecnologia quanto para aqueles que estão navegando pela primeira vez em um ambiente virtual. 
        A Dona Angela Store mantém a tradição de proximidade e cuidado com cada cliente.
      </p>
      <p>
        Nossa missão é proporcionar uma experiência agradável, funcional e segura para todos os nossos usuários. Por isso, criamos um catálogo visual e direto, para que você sinta que está sendo atendido com carinho e atenção.
      </p>
    </section>

    <section class="cartaz-container">
      <div class="cartaz">
        <img src="<?= url('/images/layout/note_tela.png') ?>" alt="Tela principal do catálogo" />
      </div>
    </section>


    <section class="devs-section">
      <h2 class="devs-title">Quem desenvolveu este catálogo</h2>

      <div class="devs-grid">
        <div class="dev-card">
          <div class="dev-photo">
            <img src="<?= url('/images/devs/tassinari.jpg') ?>" alt="Foto do desenvolvedor Lucas Tassinari" loading="lazy">
          </div>
          <div class="dev-info">
            <h3>Lucas Tassinari</h3>
            <p class="dev-role">Backend & Integrações</p>
            <p class="dev-bio">
              Focado em regras de negócio, API e segurança. Trabalhou nas
              rotas, persistência de dados e integração com o front.
            </p>
          </div>
        </div>


        <div class="dev-card">
          <div class="dev-photo">
            <img src="<?= url('/images/devs/matheus.jpg') ?>" alt="Foto do desenvolvedor Matheus Espíndola" loading="lazy">
          </div>
          <div class="dev-info">
            <h3>Matheus Espíndola</h3>
            <p class="dev-role">Frontend & UI</p>
            <p class="dev-bio">
              Responsável pelo visual, componentes e experiência do usuário.
              Criou páginas, estilos e interações do catálogo.
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
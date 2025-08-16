<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Loja de Beleza' ?></title>
    <link rel="stylesheet" href="<?= url("/assets/web/css/_theme.css") ?>">
</head>
<body>

<main>
    <?= $this->section("content") ?>
</main>
<footer class="site-footer-compact">
  <div class="footer-container">

    <!-- Contatos -->
    <section class="footer-block">
      <h2>📞 Fale Conosco</h2>
      <ul>
        <li>
          <img src="https://img.icons8.com/color/24/000000/whatsapp.png" alt="WhatsApp" />
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

    <!-- Localização -->
    <section class="footer-block" id="loc">
      <h2>📍 Localização</h2>
      <p>Instituto Federal Sul-rio-grandense <br> Campus Charqueadas – RS</p>
      <p>📬 R. Gen. Balbão, 81 - Centro, Charqueadas/RS, 96745-000</p>
      <p>🚌 Fácil acesso pela região central da cidade</p>
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3451.6816505760125!2d-51.62879882360377!3d-29.96022777498219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95196a408f0d5e0f%3A0xd0a92e8b1d879a0e!2sIFSul%20-%20Campus%20Charqueadas!5e0!3m2!1spt-BR!2sbr!4v1696948983734!5m2!1spt-BR!2sbr"
        width="100%" height="160" style="border:0;" allowfullscreen="" loading="lazy">
      </iframe>
    </section>

    <!-- FAQ -->
    <section class="footer-block">
      <h2>❓ Dúvidas Frequentes</h2>
      <ul class="faq-list">
        <li>
          <p class="pergunta">🛒 Como faço um pedido?</p>
          <p class="resposta">Escolha os produtos, adicione ao carrinho e finalize pelo WhatsApp. A Angela confirma com você!</p>
        </li>
        <li>
          <p class="pergunta">📦 Onde vocês entregam?</p>
          <p class="resposta">Entregamos na região sul de Porto Alegre, com taxa acessível. Consulte via WhatsApp!</p>
        </li>
        <li>
          <p class="pergunta">📍 Posso retirar em mãos?</p>
          <p class="resposta">Sim! Após o pedido, combinamos um horário para retirada.</p>
        </li>
        <li>
          <p class="pergunta">✔ Os produtos são originais?</p>
          <p class="resposta">Sim, todos os produtos são originais da Natura e Boticário.</p>
        </li>
        <li>
          <p class="pergunta">🔎 Posso encomendar algo que não está no site?</p>
          <p class="resposta">Claro! É só chamar no WhatsApp que verificamos para você.</p>
        </li>
        <li>
          <p class="pergunta"></p>
          <p class="resposta"><a href="/Dona-Angela-Store-/faqs" id="faq-link">👉 Tem uma dúvida? Mande aqui! 👈</a></p>
        </li>
      </ul>
    </section>

  </div>
</footer>
</body>
</html>
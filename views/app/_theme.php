<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Loja de Beleza' ?></title>
    <link rel="stylesheet" href="<?= url("/assets/app/css/_theme.css") ?>">
</head>
<body>

<main>
    <?= $this->section("content") ?>
</main>
<footer class="site-footer-compact">
    <div class="footer-container">
      
      <!-- Contatos -->
      <section class="footer-contact">
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
</body>
</html>
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
  <link rel="stylesheet" href="<?= url("/assets/app/css/about.css") ?>">
</head>
<body>
  <header class="cabecalho-compras">
    <button type="button" class="btn-voltar" onclick="window.history.back()">← Voltar</button>
    <h1>Sobre</h1>
  </header>

  <main class="sobre-container">
    <section class="texto-sobre">
      <h2>Quem são os desenvolvedores?</h2>
        <h3>Lucas Tassinari</h3>
            <p>
                Aluno da INF3AM, 17 anos. Progamador Java e Backend, adorador do VSCode e desprezador do php.
            </p>
        <h3>Matheus Espíndola</h3>
            <p>
                Colega de Lucas Tassinari, 17 anos. Desenvolvedor Frontend e progamador SQL, adora um bom WorkBench.
            </p>
      <p>
        Este espaço foi criado para facilitar suas compras, trazer mais praticidade ao dia a dia e manter a proximidade
        que sempre foi marca registrada da Dona Angela.
      </p>
    </section>
  </main>
</body>
</html>
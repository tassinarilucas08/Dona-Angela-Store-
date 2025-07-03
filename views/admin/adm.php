<?php
 $this->layout("_theme",[
    "title" => "ADM"
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= url("/assets/admin/css/adm.css") ?>">
</head>
<body>
<div class="adm-wrapper">
    <div class="container">
      <button class="btn-voltar" type="button" onclick="window.history.back()">← Voltar</button>

      <h1>Painel Administrativo</h1>

      <!-- Adicionar Cliente -->
      <section class="section">
        <h2>Adicionar Cliente</h2>
        <form>
          <label for="nome">Nome Completo</label>
          <input type="text" id="nome" name="nome" required />

          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" required />

          <label for="telefone">Telefone</label>
          <input type="tel" id="telefone" name="telefone" required />

          <label for="rua">Rua</label>
          <input type="text" id="rua" name="rua" required />

          <label for="numero">Número</label>
          <input type="number" id="numero" name="numero" required />

          <label for="complemento">Complemento</label>
          <input type="text" id="complemento" name="complemento" />

          <label for="cidade">Cidade</label>
          <input type="text" id="cidade" name="cidade" required />

          <label for="estado">Estado</label>
          <input type="text" id="estado" name="estado" required />

          <label for="cep">CEP</label>
          <input type="text" id="cep" name="cep" required />

          <button type="submit">Adicionar Cliente</button>
        </form>
      </section>

      <!-- Gerenciar Cliente -->
      <section class="gerenciar-clientes">
        <h2>Gerenciar Clientes</h2>
        <form>
          <label for="clientes">Selecionar Cliente</label>
          <select id="clientes" name="clientes" required>
            <option value="">...</option>
            <option value="1">Joana Silva</option>
            <option value="2">Carlos Oliveira</option>
            <option value="3">Maria dos Anjos</option>
          </select>

          <label for="idCliente">ID do Cliente</label>
          <input type="text" id="idCliente" name="idCliente"/>

          <label for="nome-editar">Nome Completo</label>
          <input type="text" id="nome-editar" name="nome-editar" />

          <label for="email-editar">E-mail</label>
          <input type="email" id="email-editar" name="email-editar" />

          <label for="telefone-editar">Telefone</label>
          <input type="tel" id="telefone-editar" name="telefone-editar" />

          <label for="rua-editar">Rua</label>
          <input type="text" id="rua-editar" name="rua-editar" />

          <label for="numero-editar">Número</label>
          <input type="number" id="numero-editar" name="numero-editar" />

          <label for="complemento-editar">Complemento</label>
          <input type="text" id="complemento-editar" name="complemento-editar" />

          <label for="cidade-editar">Cidade</label>
          <input type="text" id="cidade-editar" name="cidade-editar" />

          <label for="estado-editar">Estado</label>
          <input type="text" id="estado-editar" name="estado-editar" />

          <label for="cep-editar">CEP</label>
          <input type="text" id="cep-editar" name="cep-editar" />

          <div class="button-group">
            <button type="submit">Atualizar Cliente</button>
            <button type="button">Excluir Cliente</button>
          </div>
        </form>
      </section>
    </div>
  </div>
</body>
</html>
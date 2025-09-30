<?php
 $this->layout("_theme",[
    "title" => "Vendedor"
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= url("/assets/admin/css/seller.css") ?>">
    <script src="<?= url("/assets/admin/js/seller.js") ?>" defer></script>
  </head>
<body>
<div class="vendedor-wrapper">
    <div class="container">
      
      <button class="btn-voltar" type="button" onclick="window.history.back()">← Voltar</button>

      <h1>Painel do Vendedor</h1>

      <!-- Criar Produto -->
      <section class="criar-produto">
        <h2>Criar Produto</h2>
        <form>
          <label for="nome">Nome do Produto:</label>
          <input type="text" id="nome" name="nome">

          <label for="descricao">Descrição:</label>
          <textarea id="descricao" name="descricao"></textarea>

          <label for="preco">Preço:</label>
          <input type="number" id="preco" name="preco">

        <label for="imagens">Imagens do Produto: (Na ordem de visualização)</label>
        <div class="file-upload">
          <label for="imagens" class="upload-label">📁 Escolher Arquivos</label>
          <input type="file" id="imagens" name="imagens[]" multiple>
          <span id="file-name">Nenhum arquivo selecionado</span>
        </div>
        <div id="preview-imagens" class="preview-container"></div>

          <label for="status">Status:</label>
          <select id="status" name="status">
            <option value="">...</option>
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
          </select>

          <label for="categoria">Categoria:</label>
          <select id="categoria" name="categoria">
            <option value="">...</option>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
          </select>
           
          <label for="marca">Marca:</label>
          <select id="marca" name="marca">
            <option value="">...</option>
            <option value="natura">Natura</option>
            <option value="oboticario">Oboticário</option>
          </select>

          <button type="submit">Adicionar Produto</button>
        </form>
      </section>

      <!-- Gerenciar Produto -->
      <section class="gerenciar-produtos">
        <h2>Gerenciar Produtos</h2>
        <form>
          <label for="selecionar-produto">Selecionar Produto:</label>
          <select id="selecionar-produto" name="selecionar-produto">
            <option value="">...</option>
            <option value="lily">Lily</option>
            <option value="biografia">Biografia</option>
          </select>

          <label for="nome-atualizar">Nome:</label>
          <input type="text" id="nome-atualizar" name="nome-atualizar">

          <label for="descricao-atualizar">Descrição:</label>
          <textarea id="descricao-atualizar" name="descricao-atualizar"></textarea>

          <label for="preco-atualizar">Preço:</label>
          <input type="number" id="preco-atualizar" name="preco-atualizar" step="0.01">

          <label for="imagem-atualizar">Imagem (em observação):</label>
          <input type="number" id="imagem-atualizar" name="imagem-atualizar">

          <label for="quantidade-atualizar">Quantidade:</label>
          <div class="quantidade-wrapper">
            <input type="number" id="quantidade-atualizar" name="quantidade-atualizar" min="0" value="0">
            <button type="button">-</button>
            <button type="button">+</button>
          </div>

          <label for="status-atualizar">Status:</label>
          <select id="status-atualizar" name="status-atualizar">
            <option value="">...</option>
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
          </select>

          <label for="categoria-atualizar">Categoria:</label>
          <select id="categoria-atualizar" name="categoria-atualizar">
            <option value="">...</option>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
          </select>

          <div class="botoes-gerenciar">
            <button type="submit">Atualizar Produto</button>
            <button type="submit">Excluir Produto</button>
          </div>
        </form>
      </section>

    </div>
  </div>
</body>
</html>
<?php
 $this->layout("_theme",[
    "title" => "Perfil"
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= url("/assets/app/css/profile.css") ?>">
  <script src="<?= url("/assets/app/js/profile.js") ?>" defer></script>
</head>
<body>
  <div class="perfil-wrapper">
    <button class="btn-voltar" onclick="window.history.back()">← Voltar</button>
    <h1>Sua conta</h1>
    <div class="card perfil-info">
      <div class="perfil-container">
        <div class="perfil-imagem">
          <img id = "photoView" alt="Foto de perfil" width="150">
        </div>
        <div class="dados">
          <h2 id = "nomeView"></h2>
          <p id = "emailView"></p>
          <p id = "phoneView"></p>
        </div>
      </div>
      <div class="botoes-conta">
        <button class="btn-alterar" onclick="abrirModalEdicao()">ALTERAR DADOS ✎</button>
        <button class="btn-excluir-conta" onclick="abrirModalExcluirConta()">Excluir Conta</button>
      </div>
    </div>

    <h2 class="subtitulo">ENDEREÇOS</h2>
    <div class="enderecos">
      <div class="card novo-endereco">
        <button class="adicionar" onclick="abrirModalEndereco()">＋ Adicionar novo endereço</button>
      </div>
    </div>
  </div>

  <!-- MODAL ALTERAR DADOS -->
  <div class="modal" id="modal-edicao">
    <div class="modal-content">
      <h3>Alterar Dados</h3>
      <form id="formEdit">
      <label for="nova-imagem" class="photo">Foto de perfil:</label>
      <div class="file-upload">
        <label for="upload" class="upload-label">📁 Escolher Arquivo</label>
        <input type="file" id="upload" class="input-file" name="imagem">
        <span id="file-name">Nenhum arquivo selecionado</span>
      </div>
      <label for="novo-nome">Nome:</label>
      <input type="text" id="novo-nome" value="">
      <label for="novo-email">E-mail:</label>
      <input type="email" id="novo-email" value="">
      <label for="novo-email">Telefone:</label>
      <input type="phone" id="novo-telefone" value="">
      <div class="modal-buttons">
        <div class="modal-buttons">
      <button type="button" onclick="fecharModalEdicao()">Cancelar</button>
      <button type="submit" class="salvar" id="buttonSave">Salvar</button>
      </div>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL NOVO ENDEREÇO -->
  <div class="modal" id="modal-endereco">
    <div class="modal-content">
      <h3>Novo Endereço</h3>
      <input type="text" placeholder="Rua" id="street">
      <input type="text" placeholder="Número" id="number">
      <input type="text" placeholder="Complemento" id="complement">
      <input type="text" placeholder="Bairro" id="neighborhood">
      <input type="text" placeholder="Cidade" id="city">
      <input type="text" placeholder="Estado (sigla)" id="state">
      <input type="text" placeholder="CEP" id="zipCode">
      <div class="modal-buttons">
        <button onclick="fecharModalEndereco()">Cancelar</button>
        <button class="salvar" onclick="salvarEndereco()">Adicionar</button>
      </div>
    </div>
  </div>

  <!-- MODAL EDITAR ENDEREÇO EXISTENTE -->
  <div class="modal" id="modal-editar-endereco">
    <div class="modal-content">
      <h3>Editar Endereço</h3>
      <form id="formEditEndereco"></form>
      <label for="nova-rua">Nome:</label>
      <input type="text" placeholder="Rua" id="newStreet">
      <label for="novo-numero">Nome:</label>
      <input type="text" placeholder="Número" id="newNumber">
      <label for="novo-complemento">Nome:</label>
      <input type="text" placeholder="Complemento" id="newComplement">
      <label for="novo-bairro">Nome:</label>
      <input type="text" placeholder="Bairro" id="newNeighborhood">
      <label for="nova-cidade">Nome:</label>
      <input type="text" placeholder="Cidade" id="newCity">
      <label for="novo-estado">Nome:</label>
      <input type="text" placeholder="Estado" id="newState">
      <label for="novo-cep">Nome:</label>
      <input type="text" placeholder="CEP" id="newZipCode">
      <div class="modal-buttons">
        <button onclick="fecharModalEditarEndereco()">Cancelar</button>
        <button class="salvar" onclick="EditarEndereco()">Salvar Alterações</button>
      </div>
    </div>
  </div>

  <!-- MODAL EXCLUIR CONTA -->
  <div class="modal" id="modal-excluir-conta">
    <div class="modal-content">
      <h3>Deseja realmente excluir sua conta?</h3>
      <p>Esta ação é irreversível e todos os seus dados serão removidos.</p>
      <div class="modal-buttons">
          <button onclick="fecharModalExcluirConta()">Cancelar</button>
          <button class="salvar" onclick="confirmarExclusao()">Confirmar Exclusão</button>
      </div>
    </div>
  </div>
</body>
</html>
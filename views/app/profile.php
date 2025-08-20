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
          <img src="<?= url("/images/layout/user.png") ?>" alt="Foto do usuário">
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
      <div class="card endereco">
        <p><strong>Rua das Flores, 123</strong></p>
        <p>Centro - Casa</p>
        <p>Montoral | Porto Alegre - RS</p>
        <button class="editar" onclick="abrirModalEditarEndereco()">✎</button>
      </div>
      <div class="card novo-endereco">
        <button class="adicionar" onclick="abrirModalEndereco()">＋ Adicionar novo endereço</button>
      </div>
    </div>
  </div>

  <!-- MODAL ALTERAR DADOS -->
  <div class="modal" id="modal-edicao">
    <div class="modal-content">
      <h3>Alterar Dados</h3>
      <label for="nova-imagem" class="photo">Foto de perfil:</label>
      <div class="file-upload">
        <label for="upload" class="upload-label">📁 Escolher Arquivo</label>
        <input type="file" id="upload" class="input-file" name="imagem">
        <span id="file-name">Nenhum arquivo selecionado</span>
      </div>
      <label for="novo-nome">Nome:</label>
      <input type="text" id="novo-nome" value="Joana Silva">
      <label for="novo-email">E-mail:</label>
      <input type="email" id="novo-email" value="joana@email.com">
      <label for="novo-email">Telefone:</label>
      <input type="email" id="novo-telefone" value="51 94567-6312">
      <div class="modal-buttons">
        <button onclick="fecharModalEdicao()">Cancelar</button>
        <button class="salvar">Salvar</button>
      </div>
    </div>
  </div>

  <!-- MODAL NOVO ENDEREÇO -->
  <div class="modal" id="modal-endereco">
    <div class="modal-content">
      <h3>Novo Endereço</h3>
      <input type="text" placeholder="Rua">
      <input type="text" placeholder="Número">
      <input type="text" placeholder="Complemento">
      <input type="text" placeholder="Bairro">
      <input type="text" placeholder="Cidade">
      <input type="text" placeholder="Estado">
      <input type="text" placeholder="CEP">
      <div class="modal-buttons">
        <button onclick="fecharModalEndereco()">Cancelar</button>
        <button class="salvar">Adicionar</button>
      </div>
    </div>
  </div>

  <!-- MODAL EDITAR ENDEREÇO EXISTENTE -->
  <div class="modal" id="modal-editar-endereco">
    <div class="modal-content">
      <h3>Editar Endereço</h3>
      <input type="text" placeholder="Rua" value="Rua das Flores">
      <input type="text" placeholder="Número" value="123">
      <input type="text" placeholder="Complemento" value="Casa">
      <input type="text" placeholder="Bairro" value="Centro">
      <input type="text" placeholder="Cidade" value="Montoral">
      <input type="text" placeholder="Estado" value="RS">
      <input type="text" placeholder="CEP" value="99999-000">
      <div class="modal-buttons">
        <button onclick="fecharModalEditarEndereco()">Cancelar</button>
        <button class="salvar">Salvar Alterações</button>
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
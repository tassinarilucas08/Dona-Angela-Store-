<?php
 $this->layout("_theme",[
    "title" => "Perfil"
]);
?>

    <style>
        body {
        margin: 0;
        padding: 20px;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f2f2f2;
        }

        .perfil-wrapper {
        max-width: 900px;
        margin: auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        position: relative;
        }

        .btn-voltar {
        position: absolute;
        top: 20px;
        left: 30px;
        padding: 6px 14px;
        background-color: #d04c92;
        color: white;
        font-size: 14px;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        .btn-voltar:hover {
        background-color: #b3387c;
        }

        h1 {
        text-align: center;
        color: #a62c7b;
        margin-bottom: 30px;
        }

        .card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .perfil-info h2 {
        margin: 0;
        color: #333;
        }

        .perfil-info p {
        margin: 4px 0;
        color: #666;
        }

        .alterar button {
        background-color: transparent;
        border: none;
        color: #a62c7b;
        font-weight: bold;
        cursor: pointer;
        font-size: 14px;
        }

        .btn-excluir-conta {
        margin-top: 10px;
        background-color: #ff4d4d;
        color: white;
        font-size: 14px;
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        .btn-excluir-conta:hover {
        background-color: #d93636;
        }

        .botoes-conta {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;
        }

        .btn-alterar {
        background-color: transparent;
        border: none;
        color: #a62c7b;
        font-weight: bold;
        cursor: pointer;
        font-size: 14px;
        }

        .btn-alterar:hover {
        text-decoration: underline;
        }

        .subtitulo {
        color: #a62c7b;
        font-size: 20px;
        margin-bottom: 15px;
        }

        .enderecos {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        }

        .endereco {
        flex: 1;
        min-width: 280px;
        position: relative;
        }

        .endereco .editar {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: transparent;
        border: none;
        font-size: 16px;
        color: #333;
        cursor: pointer;
        }

        .principal {
        color: #a62c7b;
        font-style: italic;
        margin-top: 8px;
        }

        .novo-endereco {
        display: flex;
        justify-content: center;
        align-items: center;
        min-width: 280px;
        }

        .novo-endereco .adicionar {
        background-color: transparent;
        border: 2px dashed #a62c7b;
        color: #a62c7b;
        font-weight: bold;
        padding: 20px;
        width: 100%;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        .novo-endereco .adicionar:hover {
        background-color: #fcecf4;
        }

        .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        background-color: rgba(0, 0, 0, 0.4);
        justify-content: center;
        align-items: center;
        z-index: 999;
        }

        .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        }

        .modal-content h3 {
        margin-top: 0;
        color: #a62c7b;
        }

        .modal-content input {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        }

        .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        }

        .modal-buttons button {
        padding: 8px 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        }

        .modal-buttons .salvar {
        background-color: #a62c7b;
        color: white;
        }

        .modal-buttons button:hover {
        opacity: 0.9;
        }
    </style>

    <div class="perfil-wrapper">
        <button class="btn-voltar" onclick="window.history.back()">← Voltar</button>

        <h1>Sua conta</h1>

        <div class="card perfil-info">
        <div class="dados">
            <h2>Joana Silva</h2>
            <p>e-mail: joana@email.com</p>
            <p>telefone: 51 94567-6312</p>
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

  <script>
    function abrirModalEdicao() {
      document.getElementById("modal-edicao").style.display = "flex";
    }
  
    function fecharModalEdicao() {
      document.getElementById("modal-edicao").style.display = "none";
    }
  
    function abrirModalEndereco() {
      document.getElementById("modal-endereco").style.display = "flex";
    }
  
    function fecharModalEndereco() {
      document.getElementById("modal-endereco").style.display = "none";
    }
  
    function abrirModalEditarEndereco() {
      document.getElementById("modal-editar-endereco").style.display = "flex";
    }
  
    function fecharModalEditarEndereco() {
      document.getElementById("modal-editar-endereco").style.display = "none";
    }
  
    function abrirModalExcluirConta() {
      document.getElementById("modal-excluir-conta").style.display = "flex";
    }
  
    function fecharModalExcluirConta() {
      document.getElementById("modal-excluir-conta").style.display = "none";
    }
  
    function confirmarExclusao() {
      fecharModalExcluirConta();
      window.location.href = '/Dona-Angela-Store-/';
    }
  </script>
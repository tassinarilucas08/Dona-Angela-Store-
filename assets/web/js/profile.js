function abrirModalEdicao() {
    document.querySelector("#modal-edicao").style.display = "flex";
  }

  function fecharModalEdicao() {
    document.querySelector("#modal-edicao").style.display = "none";
  }

  function abrirModalEndereco() {
    document.querySelector("#modal-endereco").style.display = "flex";
  }

  function fecharModalEndereco() {
    document.querySelector("#modal-endereco").style.display = "none";
  }

  function abrirModalEditarEndereco() {
    document.querySelector("#modal-editar-endereco").style.display = "flex";
  }

  function fecharModalEditarEndereco() {
    document.querySelector("#modal-editar-endereco").style.display = "none";
  }

  function abrirModalExcluirConta() {
    document.querySelector("#modal-excluir-conta").style.display = "flex";
  }

  function fecharModalExcluirConta() {
    document.querySelector("#modal-excluir-conta").style.display = "none";
  }

  function confirmarExclusao() {
    fecharModalExcluirConta();
    window.location.href = '/Dona-Angela-Store-/';
  }
  console.log("OI")
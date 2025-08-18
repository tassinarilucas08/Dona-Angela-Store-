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

  // profile.js
const userData = JSON.parse(localStorage.getItem("userData"));
const userToken = localStorage.getItem("userToken");

if (!userData || !userToken) {
  alert("Você precisa estar logado!");
  window.location.href = "/Dona-Angela-Store-/login";
}

// Agora você pode usar userData e userToken em qualquer função JS
// exemplo:
console.log("Usuário logado:", userData);
console.log("Token JWT:", userToken);

let nomeView = document.querySelector("#nomeView");
let emailView = document.querySelector("#emailView");
let phoneView = document.querySelector("#phoneView");

nomeView.innerHTML = userData.name;
emailView.innerHTML = userData.email;
phoneView.innerHTML = userData.phone ? userData.phone : "Não informado";


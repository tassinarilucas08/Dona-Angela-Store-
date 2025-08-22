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

let newName = document.querySelector("#novo-nome");
let newPhone = document.querySelector("#novo-telefone");
let newEmail = document.querySelector("#novo-email");

newName.value = userData.name;
newEmail.value = userData.email;
newPhone.value = userData.phone;

// login.js
const formEdit = document.querySelector("formEdit");

formEdit.addEventListener("submit", async (e) => {
  e.preventDefault();

  if (!newName.value || !newPhone.value || newEmail.value) {
    alert("Preencha todos os campos!");
    return;
  }

  try {
    console.log(newEmail, newPhone, newName);
    const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/updateUser", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ newEmail, newPhone, newName }), // enviar senha em texto
    });

    const data = await response.json();

    if (!response.ok) {
      alert(data.message || "Erro ao fazer login");
      return;
    }

    // Salva o token e os dados do usuário no localStorage
    localStorage.setItem("userToken", data.data.token);
    localStorage.setItem("userData", JSON.stringify(data.data.user));

    alert("Login realizado com sucesso!");
    window.location.href = "/Dona-Angela-Store-/app"; // ou página principal

  } catch (error) {
    console.error("Erro ao conectar à API:", error);
    alert("Erro de conexão");
  }
});

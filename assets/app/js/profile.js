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

  // profile.js
let userData = JSON.parse(localStorage.getItem("userData"));
const userToken = localStorage.getItem("userToken");

if (!userData || !userToken) {
  alert("Você precisa estar logado!");
  window.location.href = "/Dona-Angela-Store-/login";
}

function atualizaDados(){
  let name = document.querySelector("#novo-nome").value = userData.name;
  let email = document.querySelector("#novo-email").value = userData.email;
  let phone = document.querySelector("#novo-telefone").value = userData.phone;
  
  document.querySelector("#nomeView").innerHTML = userData.name;
  document.querySelector("#emailView").innerHTML = userData.email;
  document.querySelector("#phoneView").innerHTML = userData.phone ? userData.phone : "Não informado";
}
console.log("Usuário logado:", userData);
console.log("Token JWT:", userToken);

atualizaDados();

const formEdit = document.querySelector("#formEdit");

formEdit.addEventListener("submit", async (e) => {
  e.preventDefault();

  const name = document.querySelector("#novo-nome").value;
  const email = document.querySelector("#novo-email").value;
  const phone = document.querySelector("#novo-telefone").value;

  if (!name || !email || !phone) {
    alert("Preencha todos os campos!");
    return;
  } 

  try {
    const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/update", {
      method: "PUT",
      headers: { 
        "Content-Type": "application/json",
        "token": userToken
      },
      body: JSON.stringify({ name, email, phone }),
    });

    const data = await response.json();

    if (!response.ok) {
      alert(data.message || "Erro ao atualizar usuário");
      return;
    }

    localStorage.setItem("userData", JSON.stringify(data.data));
    userData = data.data;
    atualizaDados();

    alert("Dados atualizados com sucesso!");

  } catch (error) {
    console.error("Erro ao conectar à API:", error);
    alert("Erro de conexão");
  }
});

async function confirmarExclusao() {
  try {
    const url = `http://localhost/Dona-Angela-Store-/api/Users/delete/id/${userData.id}`;

    const resp = await fetch(url, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        "token": userToken
      }
    });

    const json = await resp.json();

    if (!resp.ok) {
      alert(json.message || "Não foi possível excluir a conta.");
      return;
    }

    // Sucesso: limpar sessão e redirecionar
    localStorage.removeItem("userToken");
    localStorage.removeItem("userData");
    alert("Conta excluída com sucesso.");
    window.location.href = "/Dona-Angela-Store-/";
  } catch (e) {
    console.error(e);
    alert("Erro ao excluir conta. Tente novamente em instantes.");
  }
}
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

const fileInput = document.querySelector("#upload");
const fileNameSpan = document.querySelector("#file-name");
const preview = document.querySelector("#photoView");

fileInput?.addEventListener("change", () => {
  const file = fileInput.files[0];
  if (file) {
    if (fileNameSpan) fileNameSpan.textContent = `Arquivo selecionado: ${file.name}`;
    if (preview) preview.src = URL.createObjectURL(file);
  } else {
    if (fileNameSpan) fileNameSpan.textContent = "Nenhum arquivo selecionado";
    if (preview) preview.src = "/Dona-Angela-Store-/images/layout/user.png";
  }
});

async function atualizaFoto() {
  const file = fileInput?.files?.[0];
  if (!file) return;

  const formData = new FormData();
  formData.append("photo", file);

  try {
    const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/photo", {
      method: "POST",
      headers: { "token": userToken },
      body: formData
    });
    const data = await response.json();

    if (!response.ok) {
      alert(data.message || "Erro ao atualizar foto");
      return;
    }

    if (preview) preview.src = data.data.photo;
    userData.photo = data.data.photo;
    localStorage.setItem("userData", JSON.stringify(userData));
    alert("Foto atualizada com sucesso!");
  } catch (e) {
    console.error(e);
    alert("Erro ao enviar a foto. Tente novamente.");
  }
}

function atualizaDados() {
  document.querySelector("#novo-nome").value = userData.name || "";
  document.querySelector("#novo-email").value = userData.email || "";
  document.querySelector("#novo-telefone").value = userData.phone || "";

  document.querySelector("#nomeView")?.append?.();
  document.querySelector("#nomeView").textContent = userData.name || "";
  document.querySelector("#emailView").textContent = userData.email || "";
  document.querySelector("#phoneView").textContent = userData.phone ? userData.phone : "Não informado";
  if (preview) preview.src = userData.photo || "/Dona-Angela-Store-/images/layout/user.png";
}
console.log("Usuário logado:", userData);
console.log("Token JWT:", userToken);

atualizaDados();
carregarEnderecos();

const formEdit = document.querySelector("#formEdit");
formEdit?.addEventListener("submit", async (e) => {
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
      headers: { "Content-Type": "application/json", "token": userToken },
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
    fecharModalEdicao();
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
      headers: { "Content-Type": "application/json", "token": userToken }
    });

    const data = await resp.json();

    if (!resp.ok) {
      alert(data.message || "Não foi possível excluir a conta.");
      return;
    }

    localStorage.removeItem("userToken");
    localStorage.removeItem("userData");
    alert("Conta excluída com sucesso.");
    window.location.href = "/Dona-Angela-Store-/";
  } catch (e) {
    console.error(e);
    alert("Erro ao excluir conta. Tente novamente em instantes.");
  }
}

function cardEndereco({ street, number, complement, neighborhood, city, state }) {
  const card = document.createElement("div");
  card.className = "card endereco";
  card.innerHTML = `
    <p><strong>${street}, ${number}</strong></p>
    <p>${neighborhood}${complement ? " - " + complement : ""}</p>
    <p>${city} | ${state}</p>
    <button class="editar" onclick="abrirModalEditarEndereco()">✎</button>
  `;
  return card;
}

/* controla o grid:
   - 0 endereços: só o botão (coluna 1)
   - 1 endereço : botão vai pra direita (sem .stack)
   - 2+         : empilha (vira 1 coluna) e esconde/desativa o botão  */
function ajustaLayoutEnderecos() {
  const container = document.querySelector(".enderecos");
  const addCard = container.querySelector(".card.endereco.add");
  const btnAdd  = addCard?.querySelector(".adicionar");
  const qt = container.querySelectorAll(".card.endereco:not(.add)").length;

  // estado padrão
  container.classList.remove("stack");
  if (addCard) addCard.style.display = "flex";
  if (btnAdd) { btnAdd.disabled = false; btnAdd.title = ""; }

  if (qt >= 2) {
    // 2 ou mais: empilha e some o botão
    container.classList.add("stack");
    if (addCard) addCard.style.display = "none";
    if (btnAdd) {
      btnAdd.disabled = true;
      btnAdd.title = "Você já cadastrou 2 endereços. Não é possível adicionar mais.";
    }
  }
}

async function carregarEnderecos() {
  try {
    const resp = await fetch("http://localhost/Dona-Angela-Store-/api/Addresses/", {
      headers: { "token": userToken }
    });
    const json = await resp.json();
    if (!resp.ok) {
      alert(json.message || "Falha ao listar endereços");
      return;
    }

    const enderecos_user = (json.data && json.data.addresses) ? json.data.addresses : [];

    const list = document.querySelector(".enderecos");
    if (!list) return;

    // limpa cards antigos (mantém o 'add')
    list.querySelectorAll(".card.endereco:not(.add)").forEach(n => n.remove());

    const addBlock = list.querySelector(".card.endereco.add");
    enderecos_user.forEach(e => {
      const card = cardEndereco(e);
      addBlock ? list.insertBefore(card, addBlock) : list.appendChild(card);
    });

    ajustaLayoutEnderecos();
  } catch (error) {
    console.error("Erro ao carregar endereço", error);
    alert("Erro de carregamento");
  }
}

async function salvarEndereco() {
  const zipCode = document.querySelector("#zipCode").value;
  const street = document.querySelector("#street").value;
  const number = document.querySelector("#number").value;
  const complement = document.querySelector("#complement").value;
  const neighborhood = document.querySelector("#neighborhood").value;
  const city = document.querySelector("#city").value;
  const state = document.querySelector("#state").value;

  if (!zipCode || !street || !number || !neighborhood || !city || !state) {
    alert("Preencha todos os campos.");
    return;
  }

  const address = { idUser: userData.id, zipCode, street, number, complement: complement || null, neighborhood, state, city };

  try {
    const resp = await fetch("http://localhost/Dona-Angela-Store-/api/Addresses/add", {
      method: "POST",
      headers: { "Content-Type": "application/json", "token": userToken },
      body: JSON.stringify(address)
    });

    const data = await resp.json();

    if (!resp.ok) {
      alert(data.message || "Não foi possível criar o endereço.");
      return;
    }

    const created = data.data;

    const list = document.querySelector(".enderecos");
    const addBlock = list.querySelector(".card.endereco.add");
    const card = cardEndereco(created);
    addBlock ? list.insertBefore(card, addBlock) : list.appendChild(card);

    // limpa inputs
    ["zipCode","street","number","complement","neighborhood","city","state"]
      .forEach(id => { const el = document.querySelector(`#${id}`); if (el) el.value = ""; });

    fecharModalEndereco();
    ajustaLayoutEnderecos();
    alert("Endereço criado com sucesso.");
  } catch (error) {
    console.error(error);
    alert("Erro ao criar endereço. Tente novamente.");
  }
}

function editarEndereco() {
  const zipCode = document.querySelector("#zipCode").value;
  const street = document.querySelector("#street").value;
  const number = document.querySelector("#number").value;
  const complement = document.querySelector("#complement").value;
  const neighborhood = document.querySelector("#neighborhood").value;
  const city = document.querySelector("#city").value;
  const state = document.querySelector("#state").value;
}

function cancelarEdicao() {
  if (fileInput) fileInput.value = "";
  if (fileNameSpan) fileNameSpan.textContent = "Nenhum arquivo selecionado";
  if (preview) preview.src = userData.photo || "/Dona-Angela-Store-/images/layout/user.png";
  fecharModalEdicao();
}

async function salvarEdicao(e) {
  e.preventDefault();
  await atualizaFoto();
  fecharModalEdicao();
}

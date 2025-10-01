document.addEventListener("DOMContentLoaded", () => {
  window.abrirModalEdicao = function () {
    const el = document.querySelector("#modal-edicao");
    if (el) el.style.display = "flex";
  };

  window.fecharModalEdicao = function () {
    const el = document.querySelector("#modal-edicao");
    if (el) el.style.display = "none";
  };

  function qtdEnderecos() {
    return document.querySelectorAll(".enderecos .card.endereco:not(.add)").length;
  }
  window.abrirModalEndereco = function () {
    if (qtdEnderecos() >= 2) {
      const btn = document.querySelector(".card.endereco.add .adicionar");
      if (btn) btn.title = "Você já cadastrou 2 endereços. Não é possível adicionar mais.";
      return;
    }
    const el = document.querySelector("#modal-endereco");
    if (el) el.style.display = "flex";
  };

  window.fecharModalEndereco = function () {
    const el = document.querySelector("#modal-endereco");
    if (el) el.style.display = "none";
  };

  window.abrirModalEditarEndereco = function () {
    const el = document.querySelector("#modal-editar-endereco");
    if (el) el.style.display = "flex";
  };

  window.fecharModalEditarEndereco = function () {
    const el = document.querySelector("#modal-editar-endereco");
    if (el) el.style.display = "none";
  };

  window.abrirModalExcluirConta = function () {
    const el = document.querySelector("#modal-excluir-conta");
    if (el) el.style.display = "flex";
  };

  window.fecharModalExcluirConta = function () {
    const el = document.querySelector("#modal-excluir-conta");
    if (el) el.style.display = "none";
  };

  let userData = null;
  let userToken = null;

  try {
    userData = JSON.parse(localStorage.getItem("userData"));
    userToken = localStorage.getItem("userToken");
  } catch (e) {
    console.error("Erro ao ler userData do localStorage", e);
  }

  if (!userData || !userToken) {
    alert("Você precisa estar logado!");
    window.location.href = "/Dona-Angela-Store-/login";
    return;
  }

  const fileInput = document.querySelector("#upload");
  const fileNameSpan = document.querySelector("#file-name");
  const preview = document.querySelector("#photoView");

  if (fileInput) {
    fileInput.addEventListener("change", () => {
      const file = fileInput.files[0];
      if (file) {
        if (fileNameSpan) fileNameSpan.textContent = `Arquivo selecionado: ${file.name}`;
        if (preview) preview.src = URL.createObjectURL(file);
      } else {
        if (fileNameSpan) fileNameSpan.textContent = "Nenhum arquivo selecionado";
        if (preview) preview.src = "/Dona-Angela-Store-/images/layout/user.png";
      }
    });
  }

  async function atualizaFoto() {
    if (!fileInput || !fileInput.files || !fileInput.files[0]) return;

    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append("photo", file);

    try {
      const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/photo", {
        method: "POST",
        headers: { token: userToken },
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
    const nomeInput = document.querySelector("#novo-nome");
    const emailInput = document.querySelector("#novo-email");
    const telInput = document.querySelector("#novo-telefone");

    const nomeView = document.querySelector("#nomeView");
    const emailView = document.querySelector("#emailView");
    const phoneView = document.querySelector("#phoneView");

    if (nomeInput) nomeInput.value = userData.name || "";
    if (emailInput) emailInput.value = userData.email || "";
    if (telInput) telInput.value = userData.phone || "";

    if (nomeView) nomeView.textContent = userData.name || "";
    if (emailView) emailView.textContent = userData.email || "";
    if (phoneView) phoneView.textContent = userData.phone ? userData.phone : "Não informado";
    if (preview) preview.src = userData.photo || "/Dona-Angela-Store-/images/layout/user.png";
  }

  console.log("Usuário logado:", userData);
  console.log("Token JWT:", userToken);

  atualizaDados();

  const formEdit = document.querySelector("#formEdit");
  if (formEdit) {
    formEdit.addEventListener("submit", async (e) => {
      e.preventDefault();

      const name = (document.querySelector("#novo-nome") || {}).value || "";
      const email = (document.querySelector("#novo-email") || {}).value || "";
      const phone = (document.querySelector("#novo-telefone") || {}).value || "";

      if (!name || !email || !phone) {
        alert("Preencha todos os campos!");
        return;
      }

      try {
        const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/update", {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
            token: userToken
          },
          body: JSON.stringify({ name, email, phone })
        });

        const data = await response.json();

        if (!response.ok) {
          alert(data.message || "Erro ao atualizar usuário");
          return;
        }

        localStorage.setItem("userData", JSON.stringify(data.data));
        userData = data.data;
        atualizaDados();
        window.fecharModalEdicao();
        alert("Dados atualizados com sucesso!");
      } catch (error) {
        console.error("Erro ao conectar à API:", error);
        alert("Erro de conexão");
      }
    });
  }

  window.confirmarExclusao = async function () {
    try {
      const url = `http://localhost/Dona-Angela-Store-/api/Users/delete/id/${userData.id}`;

      const resp = await fetch(url, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
          token: userToken
        }
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
  };


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

  function ajustaLayoutEnderecos() {
    const container = document.querySelector(".enderecos");
    if (!container) return;
  
    const addCard = container.querySelector(".card.endereco.add");
    const btnAdd  = addCard?.querySelector(".adicionar");
    const qt      = container.querySelectorAll(".card.endereco:not(.add)").length;
  
    container.classList.remove("one");
  
    if (addCard) addCard.style.display = "flex";
  
    if (btnAdd) {
      btnAdd.removeAttribute("disabled");
      btnAdd.title = "";
    }
  
    if (qt === 0) {
    } else if (qt === 1) {
      container.classList.add("one");
    } else {
      if (btnAdd) {
        btnAdd.setAttribute("disabled", "disabled");
        btnAdd.title = "Você já cadastrou 2 endereços. Não é possível adicionar mais.";
      }
    }
  }
  
  async function carregarEnderecos() {
    try {
      const resp = await fetch("http://localhost/Dona-Angela-Store-/api/Addresses/", {
        headers: { token: userToken }
      });
      const json = await resp.json();
      if (!resp.ok) {
        alert(json.message || "Falha ao listar endereços");
        return;
      }

      const enderecos_user = (json.data && json.data.addresses) ? json.data.addresses : [];
      const list = document.querySelector(".enderecos");
      if (!list) return;

      // limpa todos os cards de endereço (menos o "add") - CORRIGIDO seletor
      list.querySelectorAll(".card.endereco:not(.add)").forEach((n) => n.remove());

      const addBlock = list.querySelector(".card.endereco.add");
      enderecos_user.forEach((e) => {
        const card = cardEndereco(e);
        addBlock ? list.insertBefore(card, addBlock) : list.appendChild(card);
      });

      ajustaLayoutEnderecos();
    } catch (error) {
      console.error("Erro ao carregar endereço", error);
      alert("Erro de carregamento");
    }
  }

  window.salvarEndereco = async function () {
    const zipCode = (document.querySelector("#zipCode") || {}).value || "";
    const street = (document.querySelector("#street") || {}).value || "";
    const number = (document.querySelector("#number") || {}).value || "";
    const complement = (document.querySelector("#complement") || {}).value || "";
    const neighborhood = (document.querySelector("#neighborhood") || {}).value || "";
    const city = (document.querySelector("#city") || {}).value || "";
    const state = (document.querySelector("#state") || {}).value || "";

    if (!zipCode || !street || !number || !neighborhood || !city || !state) {
      alert("Preencha todos os campos.");
      return;
    }

    const address = {
      idUser: userData.id,
      zipCode,
      street,
      number,
      complement: complement || null,
      neighborhood,
      state,
      city
    };

    try {
      const resp = await fetch("http://localhost/Dona-Angela-Store-/api/Addresses/add", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          token: userToken
        },
        body: JSON.stringify(address)
      });

      const data = await resp.json();

      if (!resp.ok) {
        alert(data.message || "Não foi possível criar o endereço.");
        return;
      }

      // Limpa campos
      const ids = ["zipCode", "street", "number", "complement", "neighborhood", "city", "state"];
      ids.forEach((id) => {
        const el = document.querySelector(`#${id}`);
        if (el) el.value = "";
      });

      window.fecharModalEndereco();

      // Reconstrói a lista (evita duplicação e ajusta classes)
      await carregarEnderecos();

      alert("Endereço criado com sucesso.");
    } catch (error) {
      console.error(error);
      alert("Erro ao criar endereço. Tente novamente.");
    }
  };

  window.editarEndereco = function () {
    const zipCode = (document.querySelector("#zipCode") || {}).value || "";
    const street = (document.querySelector("#street") || {}).value || "";
    const number = (document.querySelector("#number") || {}).value || "";
    const complement = (document.querySelector("#complement") || {}).value || "";
    const neighborhood = (document.querySelector("#neighborhood") || {}).value || "";
    const city = (document.querySelector("#city") || {}).value || "";
    const state = (document.querySelector("#state") || {}).value || "";
    console.log({ zipCode, street, number, complement, neighborhood, city, state });
  };

  window.cancelarEdicao = function () {
    if (fileInput) fileInput.value = "";
    if (fileNameSpan) fileNameSpan.textContent = "Nenhum arquivo selecionado";
    if (preview) preview.src = userData.photo || "/Dona-Angela-Store-/images/layout/user.png";
    window.fecharModalEdicao();
  };

  window.salvarEdicao = async function (e) {
    if (e && e.preventDefault) e.preventDefault();
    await atualizaFoto();
    window.fecharModalEdicao();
  };

  carregarEnderecos();
});

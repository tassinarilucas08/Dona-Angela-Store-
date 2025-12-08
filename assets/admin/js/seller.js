const userToken = localStorage.getItem("userToken");
if (!userToken) {
  alert("Você precisa estar logado!");
  window.location.href = "/Dona-Angela-Store-/login";
}

const createProductForm = document.querySelector(".criar-produto form");
const fileInput = document.getElementById("imagens");
const fileNameSpan = document.getElementById("file-name");
const previewContainer = document.getElementById("preview-imagens");

let selectedFiles = [];

// Quantidade
document.querySelectorAll(".quantidade-wrapper").forEach(wrapper => {
  const input = wrapper.querySelector("input[type=number]");
  const btnMinus = wrapper.querySelector("button:first-of-type");
  const btnPlus = wrapper.querySelector("button:last-of-type");

  btnMinus.addEventListener("click", () => {
    let value = parseInt(input.value) || 0;
    if (value > 0) input.value = value - 1;
  });

  btnPlus.addEventListener("click", () => {
    let value = parseInt(input.value) || 0;
    input.value = value + 1;
  });
});

function atualizarPreviewImagens() {
  fileNameSpan.textContent = selectedFiles.length > 0
    ? selectedFiles.map(f => f.name).join(", ")
    : "Nenhum arquivo selecionado";

  previewContainer.innerHTML = "";
  selectedFiles.forEach((file, index) => {
    const wrapper = document.createElement("div");
    wrapper.classList.add("preview-item");
    wrapper.dataset.index = index;

    const img = document.createElement("img");
    img.src = URL.createObjectURL(file);
    img.alt = file.name;

    const btnRemove = document.createElement("button");
    btnRemove.type = "button";
    btnRemove.textContent = "✕";
    btnRemove.classList.add("preview-remove");

    btnRemove.addEventListener("click", () => {
      selectedFiles.splice(index, 1);
      atualizarPreviewImagens();
    });

    wrapper.appendChild(img);
    wrapper.appendChild(btnRemove);
    previewContainer.appendChild(wrapper);
  });
}


// Seleção e preview de imagens
fileInput.addEventListener("change", () => {
    const newFiles = Array.from(fileInput.files);

  if (selectedFiles.length + newFiles.length > 4) {
    alert("Você só pode enviar até 4 imagens!");
    return;
  }

  selectedFiles = selectedFiles.concat(newFiles);

  atualizarPreviewImagens();
  fileInput.value = "";


  fileNameSpan.textContent = selectedFiles.length > 0
    ? selectedFiles.map(f => f.name).join(", ")
    : "Nenhum arquivo selecionado";

  // redesenha o preview com botão de remover em cada imagem
  previewContainer.innerHTML = "";
  selectedFiles.forEach((file, index) => {
    const wrapper = document.createElement("div");
    wrapper.classList.add("preview-item");
    wrapper.dataset.index = index;

    const img = document.createElement("img");
    img.src = URL.createObjectURL(file);
    img.alt = file.name;

    const btnRemove = document.createElement("button");
    btnRemove.type = "button";
    btnRemove.textContent = "✕";
    btnRemove.classList.add("preview-remove");

    btnRemove.addEventListener("click", () => {
      // remove só esse arquivo do array
      selectedFiles.splice(index, 1);
      atualizarPreviewImagens();
    });

    wrapper.appendChild(img);
    wrapper.appendChild(btnRemove);
    previewContainer.appendChild(wrapper);
  });


  fileInput.value = "";
});

// Submit do formulário
createProductForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const name = document.getElementById("nome").value.trim();
  const description = document.getElementById("descricao").value.trim();
  const price = document.getElementById("preco").value.trim();
  const quantity = document.getElementById("quantidade-criar").value.trim();
  const status = document.getElementById("status").value;
  const category = document.getElementById("categoria").value;
  const brand = document.getElementById("marca").value;

  if (!name || !description || !price || !quantity || !status || !category || !brand) {
    alert("Preencha todos os campos obrigatórios!");
    return;
  }

  const token = localStorage.getItem("userToken");

  try {
    // 1️⃣ Criação do produto
    const resProduct = await fetch("http://localhost/Dona-Angela-Store-/api/Products/add", {
      method: "POST",
      headers: { 
      "Content-Type": "application/json", 
      token: userToken},
      body: JSON.stringify({
      idCategory: parseInt(category),
      idBrand: parseInt(brand),
      name: name,
      description: description,
      price: parseFloat(price),
      quantity: parseInt(quantity),
      idStatus: parseInt(status)
    }),
  });

    const dataProduct = await resProduct.json();
    if (!resProduct.ok) {
      alert(dataProduct.message || "Erro ao criar produto");
      return;
    }

    // 2️⃣ Envio das fotos só se o produto foi criado com sucesso
    if (selectedFiles.length > 0) {
      const formData = new FormData();
      selectedFiles.forEach((file, i) => formData.append(`photos[]`, file));

      formData.append("id", dataProduct.data.id); // id retornado pelo PHP

      const resPhotos = await fetch("http://localhost/Dona-Angela-Store-/api/Products/photos", {
        method: "POST",
        headers: { token: userToken },
        body: formData
      });

      const dataPhotos = await resPhotos.json();

      if (!resPhotos.ok) {
        // aqui você dá a escolha pro usuário
        const manter = confirm(
          (dataPhotos.message || "Algumas imagens não foram aceitas.") +
          "\n\nDeseja manter o produto mesmo assim, sem essas imagens?\n" +
          "Clique em OK para manter o produto.\n" +
          "Clique em Cancelar para apagar o produto e tentar novamente."
        );

        if (!manter) {
          // rollback: apaga o produto recém criado
          await fetch(`http://localhost/Dona-Angela-Store-/api/Products/delete/id/${dataProduct.data.id}`, {
            method: "POST",
            headers: { token: userToken }
          });

          alert("Produto não foi criado por causa das imagens. Ajuste as fotos e tente novamente.");
        } else {
          alert("Produto criado, mas sem as imagens que não foram aceitas.");
        }

        return;
      }
    }


alert("Produto criado com sucesso!");
    window.location.reload();

  } catch (err) {
    console.error(err);
    alert("Erro no servidor. Tente novamente mais tarde.");
  }
});


// ---------- GERENCIAR PRODUTOS ----------

const manageForm          = document.querySelector(".gerenciar-produtos form");
const selectProduto       = document.getElementById("selecionar-produto");
const inputIdAtualizar    = document.getElementById("produto-id-atualizar");
const inputNomeAtualizar  = document.getElementById("nome-atualizar");
const inputDescAtualizar  = document.getElementById("descricao-atualizar");
const inputPrecoAtualizar = document.getElementById("preco-atualizar");
const inputImgAtualizar   = document.getElementById("imagem-atualizar");
const inputQtdAtualizar   = document.getElementById("quantidade-atualizar");
const selectStatusAtual   = document.getElementById("status-atualizar");
const selectCatAtual      = document.getElementById("categoria-atualizar");
const selectMarcaAtual    = document.getElementById("marca-atualizar");
const btnAtualizar        = document.getElementById("btn-atualizar-produto");
const btnExcluir          = document.getElementById("btn-excluir-produto");

// 4.1. Preencher select com listProducts
async function carregarProdutosNoSelect() {
  try {
    const res = await fetch("http://localhost/Dona-Angela-Store-/api/Products/list", {
      headers: { token: userToken }
    });    

    const json = await res.json();
    if (!res.ok) {
      alert(json.message || "Erro ao listar produtos");
      return;
    }

    const products = json.data.products || [];

    products.forEach(p => {
      const opt = document.createElement("option");
      opt.value = p.product_name;                // vamos usar o nome para findByName
      opt.textContent = p.product_name;
      opt.dataset.id = p.product_id;             // guardo o id se precisar depois
      selectProduto.appendChild(opt);
    });
  } catch (err) {
    console.error(err);
    alert("Erro ao carregar produtos");
  }
}

carregarProdutosNoSelect();

// 4.2. Ao selecionar um produto, buscar dados via findByName
selectProduto.addEventListener("change", async () => {
  const nomeSelecionado = selectProduto.value;
  if (!nomeSelecionado) {
    // limpa form
    inputIdAtualizar.value    = "";
    inputNomeAtualizar.value  = "";
    inputDescAtualizar.value  = "";
    inputPrecoAtualizar.value = "";
    inputImgAtualizar.value   = "";
    inputQtdAtualizar.value   = 0;
    selectStatusAtual.value   = "";
    selectCatAtual.value      = "";
    selectMarcaAtual.value    = "";
    return;
  }

  try {
    const url = "http://localhost/Dona-Angela-Store-/api/Products/name/" + encodeURIComponent(nomeSelecionado);
    const res = await fetch(url, {
      headers: { token: userToken }
    });
    const json = await res.json();

    if (!res.ok) {
      alert(json.message || "Erro ao buscar produto");
      return;
    }

    const p = json.data.product;

    inputIdAtualizar.value    = p.id;
    inputNomeAtualizar.value  = p.name;
    inputDescAtualizar.value  = p.description;
    inputPrecoAtualizar.value = p.price ?? "";
    inputImgAtualizar.value   = p.photo ?? "";
    inputQtdAtualizar.value   = p.quantity ?? 0;
    selectStatusAtual.value   = p.idStatus ?? "";
    selectCatAtual.value      = p.idCategory ?? "";
    selectMarcaAtual.value    = p.idBrand ?? "";

  } catch (err) {
    console.error(err);
    alert("Erro ao carregar dados do produto");
  }
});

// 4.3. Atualizar produto
btnAtualizar.addEventListener("click", async (e) => {
  e.preventDefault();

  const id          = inputIdAtualizar.value;
  const name        = inputNomeAtualizar.value.trim();
  const description = inputDescAtualizar.value.trim();
  const price       = inputPrecoAtualizar.value.trim();
  const quantity    = inputQtdAtualizar.value.trim();
  const idStatus    = selectStatusAtual.value;
  const idCategory  = selectCatAtual.value;
  const idBrand     = selectMarcaAtual.value;

  if (!id) {
    alert("Selecione um produto primeiro");
    return;
  }

  if (!name || !description || !price || !quantity || !idStatus || !idCategory || !idBrand) {
    alert("Preencha todos os campos para atualizar");
    return;
  }

  try {
    const res = await fetch("http://localhost/Dona-Angela-Store-/api/Products/update", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        token: userToken
      },
      body: JSON.stringify({
        id: parseInt(id),
        idCategory: parseInt(idCategory),
        idBrand: parseInt(idBrand),
        name: name,
        description: description,
        price: parseFloat(price),
        quantity: parseInt(quantity),
        idStatus: parseInt(idStatus)
        // se quiser mandar salePrice depois, é só incluir aqui
      })
    });

    const json = await res.json();
    if (!res.ok) {
      alert(json.message || "Erro ao atualizar produto");
      return;
    }

    alert("Produto atualizado com sucesso!");
    window.location.reload();


    selectProduto.innerHTML = '<option value="">...</option>';
    await carregarProdutosNoSelect();
    selectProduto.value = name; // mantém selecionado
  } catch (err) {
    console.error(err);
    alert("Erro ao atualizar produto");
  }
});

// 4.4. Excluir produto
btnExcluir.addEventListener("click", async (e) => {
  e.preventDefault();

  const id = inputIdAtualizar.value;
  if (!id) {
    alert("Selecione um produto primeiro");
    return;
  }

  if (!confirm("Tem certeza que deseja excluir este produto?")) {
    return;
  }

  try {
    const res = await fetch(`http://localhost/Dona-Angela-Store-/api/Products/delete/id/${id}`, {
      method: "POST",
      headers: { token: userToken }
    });    

    const json = await res.json();
    if (!res.ok) {
      alert(json.message || "Erro ao excluir produto");
      return;
    }

    alert("Produto excluído com sucesso!");

    // remove do select e limpa formulário
    const optionToRemove = selectProduto.querySelector(`option[data-id="${id}"]`);
    if (optionToRemove) optionToRemove.remove();

    selectProduto.value      = "";
    inputIdAtualizar.value   = "";
    inputNomeAtualizar.value = "";
    inputDescAtualizar.value = "";
    inputPrecoAtualizar.value= "";
    inputImgAtualizar.value  = "";
    inputQtdAtualizar.value  = 0;
    selectStatusAtual.value  = "";
    selectCatAtual.value     = "";
    selectMarcaAtual.value   = "";

  } catch (err) {
    console.error(err);
    alert("Erro ao excluir produto");
  }
});


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

// Seleção e preview de imagens
fileInput.addEventListener("change", () => {
  const newFiles = Array.from(fileInput.files);

  // Limita para no máximo 4 arquivos
  if (selectedFiles.length + newFiles.length > 4) {
    alert("Você só pode enviar até 4 imagens!");
    return;
  }

  selectedFiles = selectedFiles.concat(newFiles);

  fileNameSpan.textContent = selectedFiles.length > 0
    ? selectedFiles.map(f => f.name).join(", ")
    : "Nenhum arquivo selecionado";

  previewContainer.innerHTML = "";
  selectedFiles.forEach(file => {
    const img = document.createElement("img");
    img.src = URL.createObjectURL(file);
    img.alt = file.name;
    previewContainer.appendChild(img);
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

      const resPhotos = await fetch("http://localhost/Dona-Angela-Store-/api/Products/updatePhotos", {
        method: "POST",
        headers: {
        token: userToken},
        body: formData
      });

      const dataPhotos = await resPhotos.json();
      if (!resPhotos.ok) {
        alert(dataPhotos.message || "Erro ao enviar fotos");
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

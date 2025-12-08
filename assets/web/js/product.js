// product.js

// deixo fora do DOMContentLoaded pra ser visível em handleAddToCart
let currentProductData = null;

document.addEventListener("DOMContentLoaded", () => {
  // Limpar textarea quando enviar avaliação
  const textArea = document.querySelector("#comentario");
  const buttonAvaliacao = document.querySelector("#avaliar");

  if (buttonAvaliacao && textArea) {
    buttonAvaliacao.addEventListener("click", () => {
      textArea.value = "";
    });
  }

  // --- Pega o ID do produto pela URL: /produto/5 ---
  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const productId = pathParts[pathParts.length - 1];

  if (!productId) {
    console.error("ID do produto não encontrado na URL");
    return;
  }

  const baseApi = "http://localhost/Dona-Angela-Store-/api/Products/id/";
  const baseImg = "http://localhost/Dona-Angela-Store-/";

  // Elementos da página que vamos preencher
  const imgElement       = document.getElementById("product-image");
  const nameElement      = document.querySelector(".nome-produto");
  const priceElement     = document.querySelector(".preco-produto");
  const descElement      = document.querySelector(".descricao-produto");
  const indicatorsHolder = document.getElementById("indicators");

  let images = [];
  let current = 0;

  function buildFullUrl(path) {
    if (!path) return baseImg + "images/default.png";
    return baseImg + path.replace(/^\/+/, "");
  }

  function updateImage() {
    if (!imgElement || images.length === 0) return;
    imgElement.src = images[current];
  }

  function updateIndicators() {
    if (!indicatorsHolder) return;

    indicatorsHolder.innerHTML = "";
    images.forEach((_, index) => {
      const dot = document.createElement("span");
      if (index === current) dot.classList.add("active");
      dot.addEventListener("click", () => {
        current = index;
        updateImage();
        updateIndicators();
      });
      indicatorsHolder.appendChild(dot);
    });
  }

  // Essas funções são chamadas pelos botões prev/next no HTML
  window.changeImage = function (step) {
    if (images.length === 0) return;
    current = (current + step + images.length) % images.length;
    updateImage();
    updateIndicators();
  };

  // --- Busca o produto na API ---
  async function carregarProduto() {
    try {
      const resp = await fetch(baseApi + productId);
      const data = await resp.json();
      console.log("Produto API:", data);

      let p =
        data?.data?.product ||    // caso 1
        data?.product ||          // caso 2
        (data?.data && !Array.isArray(data.data) ? data.data : null) || // caso 3
        (data?.id ? data : null); // caso 4

      if (!p) {
        console.error("Produto não encontrado na resposta da API");
        const container = document.querySelector(".produto-container");
        if (container) {
          container.insertAdjacentHTML(
            "afterbegin",
            `<p style="color:red;font-weight:bold">Erro: produto não encontrado na API.</p>`
          );
        }
        return;
      }

      // Nome
      const nomeProduto = p.name || p.product_name || "Produto";
      if (nameElement) {
        nameElement.textContent = nomeProduto;
      }

      // Preço: se tiver salePrice usa ele, senão price
      const precoBase = p.salePrice ?? p.price ?? 0;
      const precoNumero = Number(precoBase) || 0;
      if (priceElement) {
        priceElement.textContent =
          "R$ " + precoNumero.toFixed(2).replace(".", ",");
      }

      // Descrição
      if (descElement) {
        descElement.textContent =
          p.description || p.product_description || "Sem descrição.";
      }

      // Fotos: se findByIdWithDetails estiver retornando 'photos' como array
      let fotos = [];
      if (Array.isArray(p.photos) && p.photos.length > 0) {
        fotos = p.photos.map(buildFullUrl);
      } else if (p.photo || p.product_photo) {
        fotos = [buildFullUrl(p.photo || p.product_photo)];
      } else {
        fotos = [buildFullUrl(null)];
      }

      images = fotos;
      current = 0;
      updateImage();
      updateIndicators();

      // Normaliza dados do produto para o carrinho
      currentProductData = {
        id: Number(p.id || p.product_id || productId),
        name: nomeProduto,
        price: precoNumero,
        photo: images[0] || buildFullUrl(null),
      };

      console.log("currentProductData pronto:", currentProductData);
    } catch (err) {
      console.error("Erro ao carregar produto:", err);
    }
  }

  carregarProduto();
});

// --------- FUNÇÃO GLOBAL PARA O BOTÃO DO HTML ---------
window.handleAddToCart = function () {
  const userToken = localStorage.getItem("userToken");
  if (!userToken) {
    alert("Você precisa estar logado para adicionar produtos ao carrinho.");
    window.location.href = "/Dona-Angela-Store-/login";
    return;
  }

  if (!currentProductData) {
    alert("Produto ainda não foi carregado. Tente novamente em instantes.");
    console.error("currentProductData ainda é null");
    return;
  }

  let cart = [];
  try {
    cart = JSON.parse(localStorage.getItem("cartItems")) || [];
  } catch (e) {
    cart = [];
  }

  const existing = cart.find(item => item.id === currentProductData.id);
  if (existing) {
    existing.quantity += 1;
  } else {
    cart.push({
      ...currentProductData,
      quantity: 1,
    });
  }

  localStorage.setItem("cartItems", JSON.stringify(cart));
  alert("Produto adicionado ao carrinho!");
  // se quiser já ir pro carrinho, descomenta:
  // window.location.href = "/Dona-Angela-Store-/app/carrinho";
};
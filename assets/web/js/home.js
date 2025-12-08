// ---------------- VARS GLOBAIS ----------------
let hideTimeout;
let currentCategory = "todos"; // categoria atual
let searchTerm = "";           // texto buscado

// ---------------- FUNÇÕES GERAIS ----------------
function scrollToProdutos() {
  const produtosSection = document.querySelector("#products");
  if (produtosSection) {
    produtosSection.scrollIntoView({ behavior: "smooth" });
  }
}

function showModal() {
  clearTimeout(hideTimeout);
  document.querySelector("#modal")?.classList.add("active");
}

function hideModal() {
  document.querySelector("#modal")?.classList.remove("active");
}

function startHideModal() {
  hideTimeout = setTimeout(() => {
    document.querySelector("#modal")?.classList.remove("active");
  }, 150);
}

function cancelHideModal() {
  clearTimeout(hideTimeout);
}

// ---------------- FILTROS ----------------

/**
 * Aplica os filtros de categoria + busca, mas NÃO faz scroll.
 * O scroll só acontece quando:
 *  - clicar em uma categoria
 *  - pressionar ENTER na busca
 */
function aplicarFiltros() {
  const cards = document.querySelectorAll(".product-card");

  cards.forEach(card => {
    const termo = searchTerm.trim().toLowerCase();

    const nome = card.querySelector("h2")?.textContent.toLowerCase() || "";
    const marca = card.querySelector(".tag")?.textContent.toLowerCase() || "";
    const descricao = card.querySelector(".card-description")?.textContent.toLowerCase() || "";

    const matchesSearch =
      !termo ||
      nome.includes(termo) ||
      marca.includes(termo) ||
      descricao.includes(termo);

    const matchesCategory =
      currentCategory === "todos" || card.classList.contains(currentCategory);

    card.style.display = matchesCategory && matchesSearch ? "block" : "none";
  });
}

// ---------- Quando clicar no botão de categoria ----------
function filterProducts(category) {
  currentCategory = category;
  aplicarFiltros();
  scrollToProdutos(); // <-- AQUI SIM dá scroll
}

function handleClick(button, category) {
  button.classList.add("clicked");
  setTimeout(() => button.classList.remove("clicked"), 100);
  filterProducts(category);
}

// ---------------- CARREGAMENTO DOS PRODUTOS ----------------
document.addEventListener("DOMContentLoaded", () => {
  console.log("DOM carregado");

  const container = document.querySelector("#products");
  const baseURL = "http://localhost/Dona-Angela-Store-/api/Products/";
  const baseImg = "http://localhost/Dona-Angela-Store-/";
  const searchInput = document.querySelector(".search-box input");
  const motherInfo = document.querySelector("#mother-informations");

  motherInfo?.addEventListener("click", () => {
    showModal();
  });

  // ---------- Busca em tempo real (SEM scroll) ----------
  if (searchInput) {
    searchInput.addEventListener("input", () => {
      searchTerm = searchInput.value;
      aplicarFiltros();
    });

    // ---------- ENTER faz scroll ----------
    searchInput.addEventListener("keydown", e => {
      if (e.key === "Enter") {
        e.preventDefault();
        searchTerm = searchInput.value;
        aplicarFiltros();
        scrollToProdutos(); 
      }
    });
  }

  async function carregarProdutos() {
    try {
      const response = await fetch(baseURL);
      const data = await response.json();

      const produtos = data?.data?.products || data?.products || [];

      if (!Array.isArray(produtos) || produtos.length === 0) {
        container.innerHTML = `<p class="no-products">Nenhum produto encontrado.</p>`;
        return;
      }

      container.innerHTML = "";

      produtos.forEach(p => {
        let photo = p.product_photo || p.photo || null;

        if (photo && !photo.startsWith("http")) {
          photo = baseImg + photo.replace(/^\/+/, "");
        } else if (!photo) {
          photo = baseImg + "images/default.png";
        }

        const brand = p.brand_description || "Marca desconhecida";
        const brandClass =
          brand.toLowerCase().includes("botic") ? "boticario"
          : brand.toLowerCase().includes("natura") ? "natura"
          : "default-brand";

        const price = `R$ ${Number(p.price).toFixed(2).replace(".", ",")}`;
        const sale = p.salePrice
          ? `R$ ${Number(p.salePrice).toFixed(2).replace(".", ",")}`
          : null;

        const gender = (p.gender_description || "unissex").toLowerCase();

        const card = document.createElement("div");
        card.className = `product-card todos ${gender}`;
        card.innerHTML = `
          <span class="tag ${brandClass}">${brand}</span>
          <img src="${photo}" alt="${p.product_name}">
          <div class="product-info">
            <h2>${p.product_name}</h2>
            <p class="card-description">${p.product_description || ""}</p>
            <div class="price">
              ${
                sale
                  ? `<span class="old">${price}</span><span class="new">${sale}</span>`
                  : `<span class="normal">${price}</span>`
              }
            </div>
            <a href="/Dona-Angela-Store-/produto/${p.product_id}" class="btn-view">Ver Produto</a>
          </div>
        `;
        container.appendChild(card);
      });

      // NÃO faz scroll ao carregar.
      aplicarFiltros();
    } catch (error) {
      console.error("Erro ao buscar produtos:", error);
      container.innerHTML = `<p class="error">Erro ao carregar produtos.</p>`;
    }
  }

  carregarProdutos();
});

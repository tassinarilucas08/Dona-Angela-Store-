document.addEventListener("DOMContentLoaded", () => {
  console.log("DOM carregado");
});

function scrollToProdutos() {
  const produtosSection = document.querySelector('#products');
  produtosSection.scrollIntoView({ behavior: 'smooth' });
}

let hideTimeout;

function showModal() {
  clearTimeout(hideTimeout);
  document.querySelector('#modal').classList.add('active');
}

function startHideModal() {
  hideTimeout = setTimeout(() => {
    document.querySelector('#modal').classList.remove('active');
  }, 150);
}

function hideModal() {
  document.querySelector('#modal').classList.remove('active');
}

function cancelHideModal() {
  clearTimeout(hideTimeout);
}

document.querySelector('#mother-informations')?.addEventListener('click', () => {
  showModal();
});

function filterProducts(category) {
  const products = document.querySelectorAll('.product-card');
  products.forEach(product => {
    product.style.display = category === 'todos' || product.classList.contains(category)
      ? 'block'
      : 'none';
  });
  scrollToProdutos();
}

function handleClick(button, category) {
  button.classList.add('clicked');
  setTimeout(() => button.classList.remove('clicked'), 100);
  filterProducts(category);
}
document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector("#products");
  const baseURL = "http://localhost/Dona-Angela-Store-/api/Products/";

  async function carregarProdutos() {
    try {
      const response = await fetch(baseURL);
      const data = await response.json();

      // Suporte para múltiplas estruturas JSON
      const produtos = data?.data?.products || data?.products || [];

      if (!Array.isArray(produtos) || produtos.length === 0) {
        container.innerHTML = `<p class="no-products">Nenhum produto encontrado.</p>`;
        return;
      }

      container.innerHTML = "";
      produtos.forEach(p => {
        const photo = p.product_photo || "/Dona-Angela-Store-/images/default.png";
        const brand = p.brand_description || "Marca desconhecida";
        const price = `R$ ${Number(p.price).toFixed(2).replace(".", ",")}`;
        const sale = p.salePrice ? `R$ ${Number(p.salePrice).toFixed(2).replace(".", ",")}` : null;
        const gender = (p.gender_description || "unissex").toLowerCase();

        const card = document.createElement("div");
        card.className = `product-card todos ${gender}`;
        card.innerHTML = `
          <span class="tag">${brand}</span>
          <img src="${photo}" alt="${p.product_name}">
          <div class="product-info">
            <h2>${p.product_name}</h2>
            <p>${p.product_description || ""}</p>
            <div class="price">
              ${sale ? `<span class="old">${price}</span><span class="new">${sale}</span>` : `<span class="normal">${price}</span>`}
            </div>
            <a href="/Dona-Angela-Store-/produto/${p.product_id}" class="btn-view">Ver Produto</a>
          </div>
        `;
        container.appendChild(card);
      });
    } catch (error) {
      console.error("Erro ao buscar produtos:", error);
      container.innerHTML = `<p class="error">Erro ao carregar produtos.</p>`;
    }
  }

  carregarProdutos();

  // Filtro
  const buttons = document.querySelectorAll(".movButton");
  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      const cat = btn.textContent.trim().toLowerCase();
      btn.classList.add("clicked");
      setTimeout(() => btn.classList.remove("clicked"), 150);

      document.querySelectorAll(".product-card").forEach(card => {
        card.style.display = (cat === "todos" || card.classList.contains(cat)) ? "block" : "none";
      });
    });
  });
});
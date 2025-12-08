console.log("JS CARREGOU");

const usuario = JSON.parse(localStorage.getItem("userData"));
if (usuario) {
  document.getElementById("nomeUsuario").textContent = "Olá, " + usuario.name;
}

// ------------------ SCROLL CONTROLADO ------------------

function scrollToProdutos() {
  const produtosSection = document.querySelector('#products');
  produtosSection.scrollIntoView({ behavior: 'smooth' });
}

// ------------------ MODAL DA MÃE ------------------

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

// ------------------ API ------------------

const baseURL = "http://localhost/Dona-Angela-Store-/api/Products/";
const baseImg = "http://localhost/Dona-Angela-Store-/";

async function carregarProdutos() {
  try {
    const container = document.querySelector("#products");
    container.innerHTML = "<p>Carregando produtos...</p>";

    const response = await fetch(baseURL);
    const data = await response.json();

    const produtos = data?.data?.products || data?.products || [];

    if (!Array.isArray(produtos) || produtos.length === 0) {
      container.innerHTML = "<p>Nenhum produto encontrado.</p>";
      return;
    }

    container.innerHTML = "";

    produtos.forEach(p => {
      let photo = p.product_photo || p.photo || null;

      if (photo) {
        photo = baseImg + photo.replace(/^\/+/, "");
      } else {
        photo = baseImg + "images/default.png";
      }

      const brand = p.brand_description || "Marca desconhecida";
      const brandClass =
        brand.toLowerCase().includes("botic") ? "tag-boticario" :
        brand.toLowerCase().includes("natura") ? "tag-natura" :
        "tag-default";

      const price = `R$ ${Number(p.price).toFixed(2).replace(".", ",")}`;
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
            <span class="normal">${price}</span>
          </div>
          <a href="/Dona-Angela-Store-/app/produto/${p.product_id}" class="btn-view">
            Ver Produto
          </a>
        </div>
      `;

      container.appendChild(card);
    });

  } catch (error) {
    console.error("Erro ao carregar produtos:", error);
    document.querySelector("#products").innerHTML =
      "<p>Erro ao carregar produtos.</p>";
  }
}

carregarProdutos();

// ------------------ FILTROS ------------------

function filterProducts(category) {
  const cards = document.querySelectorAll(".product-card");

  cards.forEach(c => {
    c.style.display = (category === "todos" || c.classList.contains(category))
      ? "block"
      : "none";
  });

  scrollToProdutos();
}

function handleClick(btn, cat) {
  btn.classList.add("clicked");
  setTimeout(() => btn.classList.remove("clicked"), 150);
  filterProducts(cat);
}

// ------------------ BUSCA ------------------

document.getElementById("searchInput").addEventListener("keypress", e => {
  if (e.key === "Enter") {
    const termo = e.target.value.toLowerCase();
    const cards = document.querySelectorAll(".product-card");

    cards.forEach(c => {
      const nome = c.querySelector("h2")?.textContent.toLowerCase() || "";
      const desc = c.querySelector(".card-description")?.textContent.toLowerCase() || "";

      c.style.display =
        nome.includes(termo) || desc.includes(termo)
        ? "block"
        : "none";
    });

    scrollToProdutos();
  }
});

// ------------------ LOGOUT ------------------

document.getElementById("btnLogout").addEventListener("click", () => {
  localStorage.clear();
  window.location.href = "/Dona-Angela-Store-/";
});
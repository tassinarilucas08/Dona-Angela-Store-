// cart.js

document.addEventListener("DOMContentLoaded", () => {
    const userToken = localStorage.getItem("userToken");
    if (!userToken) {
      alert("Você precisa estar logado para acessar o carrinho.");
      window.location.href = "/Dona-Angela-Store-/login";
      return;
    }
  
    const cartContainer = document.getElementById("cart-items");
    const totalElement = document.getElementById("cart-total");
  
    function getCart() {
      try {
        return JSON.parse(localStorage.getItem("cartItems")) || [];
      } catch (e) {
        return [];
      }
    }
  
    function saveCart(cart) {
      localStorage.setItem("cartItems", JSON.stringify(cart));
    }
  
    function formatMoney(value) {
      return "R$ " + Number(value).toFixed(2).replace(".", ",");
    }
  
    function updateQuantity(index, delta) {
      const cart = getCart();
      if (!cart[index]) return;
  
      cart[index].quantity += delta;
      if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
      }
  
      saveCart(cart);
      renderCart();
    }
  
    function removeItem(index) {
      const cart = getCart();
      if (!cart[index]) return;
  
      cart.splice(index, 1);
      saveCart(cart);
      renderCart();
    }
  
    function renderCart() {
      const cart = getCart();
    
      if (!cart.length) {
        cartContainer.innerHTML = "<p class='empty-cart'>Seu carrinho está vazio.</p>";
        if (totalElement) totalElement.textContent = "R$ 0,00";
        return;
      }
    
      cartContainer.innerHTML = "";
      let total = 0;
    
      cart.forEach((item, index) => {
        const subtotal = item.price * item.quantity;
        total += subtotal;
    
        const itemDiv = document.createElement("div");
        itemDiv.classList.add("item");
    
        // guarda o id no dataset
        itemDiv.dataset.productId = item.id;
    
        itemDiv.innerHTML = `
          <button type="button" class="btn-remove" data-index="${index}">&times;</button>
    
          <img src="${item.photo}" alt="${item.name}">
          <div class="info">
            <h3>${item.name}</h3>
            <p class="price">${formatMoney(item.price)}</p>
    
            <div class="quantity-controls">
              <button type="button" class="btn-qty btn-qty-minus" data-index="${index}">−</button>
              <span class="qty">${item.quantity}</span>
              <button type="button" class="btn-qty btn-qty-plus" data-index="${index}">+</button>
            </div>
          </div>
        `;
    
        // clique no card leva pra página do produto
        itemDiv.addEventListener("click", () => {
          const id = itemDiv.dataset.productId;
          if (!id) return;
          window.location.href = `/Dona-Angela-Store-/app/produto/${id}`;
          // se tua rota for /app/produto/${id}, ajusta aqui
        });
    
        cartContainer.appendChild(itemDiv);
      });
    
      if (totalElement) {
        totalElement.textContent = formatMoney(total);
      }
    
      // Eventos dos botões de quantidade
      cartContainer.querySelectorAll(".btn-qty-plus").forEach(btn => {
        btn.addEventListener("click", (e) => {
          e.stopPropagation(); // não deixar o clique abrir a página
          const idx = parseInt(btn.dataset.index, 10);
          updateQuantity(idx, 1);
        });
      });
    
      cartContainer.querySelectorAll(".btn-qty-minus").forEach(btn => {
        btn.addEventListener("click", (e) => {
          e.stopPropagation();
          const idx = parseInt(btn.dataset.index, 10);
          updateQuantity(idx, -1);
        });
      });
    
      // Evento do botão X (remover)
      cartContainer.querySelectorAll(".btn-remove").forEach(btn => {
        btn.addEventListener("click", (e) => {
          e.stopPropagation();
          const idx = parseInt(btn.dataset.index, 10);
          removeItem(idx);
        });
      });
    }
    
    
  
    renderCart();
  });  
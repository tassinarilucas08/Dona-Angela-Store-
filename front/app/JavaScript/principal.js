function scrollToProdutos() {
    const produtosSection = document.getElementById('products');
    produtosSection.scrollIntoView({ behavior: 'smooth' });
  }
  
    let hideTimeout;

    function showModal() {
      clearTimeout(hideTimeout);
      document.getElementById('modal').classList.add('active');
    }

    function startHideModal() {
      hideTimeout = setTimeout(() => {
        document.getElementById('modal').classList.remove('active');
      }, 150);
    }

    function hideModal() {
      document.getElementById('modal').classList.remove('active');
    }

    function cancelHideModal() {
      clearTimeout(hideTimeout);
    }

    let motherInformationsClick = document.querySelector("#mother-informations");
    motherInformationsClick.addEventListener('click', ()=>{
        showModal();
    });

    function filterProducts(category) {
  const products = document.querySelectorAll('.product-card');
  products.forEach(product => {
    if (category === 'all') {
      product.style.display = 'block';
    } else {
      product.style.display = product.classList.contains(category) ? 'block' : 'none';
    }
  });
  scrollToProdutos();
}
function handleClick(button, category) {
    // Adiciona classe de animação
    button.classList.add('clicked');

    // Remove a classe após a animação
    setTimeout(() => {
      button.classList.remove('clicked');
    }, 100);

    // Chama a função de filtro
    filterProducts(category);
  }

let btnVendedor = document.querySelector("#btnVendedor");
btnVendedor.addEventListener("click", ()=> {
  location.href = "../html/vendedor.html"; // Altere para o link real
});
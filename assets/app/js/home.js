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
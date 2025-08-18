console.log("JS CARREGOU");
const usuario = JSON.parse(localStorage.getItem("usuario"));
console.log(usuario.data.user.name);

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

let btnLogout = document.querySelector("#btnLogout");

if (!btnLogout) {
  console.error("Botão de logout não encontrado!");
} else {
  btnLogout.addEventListener("click", () => {
    localStorage.clear();
    window.location.href = "/Dona-Angela-Store-/";
  });
}

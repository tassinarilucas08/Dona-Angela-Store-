let textArea = document.querySelector("#comentario");
let button = document.querySelector("#avaliar");

button.addEventListener('click', ()=> {
    textArea.value = '';
})
const images = [
  "/Dona-Angela-Store-/images/perfums/lily.jpg",
  "/Dona-Angela-Store-/images/perfums/essencial.jpg",
  "/Dona-Angela-Store-/images/perfums/zaad.jpeg"
];

let current = 0;
const imgElement = document.getElementById("product-image");
const indicatorsContainer = document.getElementById("indicators");

// Criar bolinhas dinamicamente
images.forEach((_, index) => {
  const dot = document.createElement("span");
  dot.addEventListener("click", () => goToImage(index));
  indicatorsContainer.appendChild(dot);
});

function updateIndicators() {
  document.querySelectorAll("#indicators span").forEach((dot, index) => {
    dot.classList.toggle("active", index === current);
  });
}

function changeImage(step) {
  current = (current + step + images.length) % images.length;
  imgElement.src = images[current];
  updateIndicators();
}

function goToImage(index) {
  current = index;
  imgElement.src = images[current];
  updateIndicators();
}

// Inicializa
updateIndicators();

const modal = document.querySelector("#modalEndereco");
const btn = document.querySelector("#btnEndereco");
const span = document.querySelector(".modal .close");
  
btn.onclick = () => modal.style.display = "block";
span.onclick = () => modal.style.display = "none";
window.onclick = e => {
    if (e.target === modal) modal.style.display = "none";
};
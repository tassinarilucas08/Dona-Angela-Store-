let textArea = document.querySelector("#comentario");
let button = document.querySelector("#avaliar");

button.addEventListener('click', ()=> {
    textArea.value = '';
})
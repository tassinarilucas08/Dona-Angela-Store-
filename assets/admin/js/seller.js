document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".quantidade-wrapper").forEach(wrapper => {
    const input = wrapper.querySelector("input[type=number]");
    const btnMinus = wrapper.querySelector("button:first-of-type");
    const btnPlus = wrapper.querySelector("button:last-of-type");

    btnMinus.addEventListener("click", () => {
      let value = parseInt(input.value) || 0;
      if (value > 0) input.value = value - 1;
    });

    btnPlus.addEventListener("click", () => {
      let value = parseInt(input.value) || 0;
      input.value = value + 1;
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const fileInput = document.getElementById("imagens");
  const fileNameSpan = document.getElementById("file-name");
  const previewContainer = document.getElementById("preview-imagens");

  // Array pra armazenar todos os arquivos selecionados
  let arquivosSelecionados = [];

  fileInput.addEventListener("change", () => {
    const novosArquivos = Array.from(fileInput.files);

    // Adiciona novos arquivos ao array existente
    arquivosSelecionados = arquivosSelecionados.concat(novosArquivos);

    // Atualiza o span com os nomes
    if (arquivosSelecionados.length > 0) {
      fileNameSpan.textContent = arquivosSelecionados.map(f => f.name).join(", ");
    } else {
      fileNameSpan.textContent = "Nenhum arquivo selecionado";
    }

    // Limpa o preview antes de recriar
    previewContainer.innerHTML = "";

    // Cria os previews das imagens
    arquivosSelecionados.forEach(file => {
      const img = document.createElement("img");
      img.src = URL.createObjectURL(file);
      img.alt = file.name;
      previewContainer.appendChild(img);
    });

    // Limpa o input para poder adicionar mais arquivos depois
    fileInput.value = "";
  });
});

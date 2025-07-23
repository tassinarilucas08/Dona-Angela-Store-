document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#loginForm");
  const mensagem = document.querySelector("#mensagemLogin");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const email = document.querySelector("#email").value;
    const senha = document.querySelector("#senha").value;

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    const urlencoded = new URLSearchParams();
    urlencoded.append("email", email);
    urlencoded.append("password", senha);

    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: urlencoded,
      redirect: "follow"
    };

    fetch("http://localhost/Dona-Angela-Store-/api/Users/login", requestOptions)
      .then((response) => response.json()) // ajusta se a API retornar texto
      .then((result) => {
        console.log("Resposta:", result);

        if (result.success) { // <- Ajuste isso conforme sua API
          // Salva no localStorage
          localStorage.setItem("user", JSON.stringify(result.user));

          // Mostra mensagem
          mensagem.textContent = "Login bem-sucedido!";
          mensagem.style.color = "green";

          // Redireciona após 1 segundo
          setTimeout(() => {
            window.location.href = "index.html"; // ou caminho certo
          }, 1000);
        } else {
          mensagem.textContent = "Email ou senha incorretos.";
          mensagem.style.color = "red";
        }
      })
      .catch((error) => {
        console.error("Erro:", error);
        mensagem.textContent = "Erro ao conectar com o servidor.";
        mensagem.style.color = "red";
      });
  });
});

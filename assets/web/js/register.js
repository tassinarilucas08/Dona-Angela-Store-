document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#registerForm");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Evita reload da página
    console.log("Clicado")

    const nome = document.querySelector("#nome").value;
    const email = document.querySelector("#email").value;
    const telefone = document.querySelector("#telefone").value;
    const senha = document.querySelector("#senha").value;
    const senhaConfirmar = document.querySelector("#senhaConfirmar").value;
    const termosAceitos = document.querySelector("#termos").checked;

    // Verificação básica
    if (senha !== senhaConfirmar) {
      alert("As senhas não coincidem.");
      return;
    }

    if (!termosAceitos) {
      alert("Você precisa aceitar os Termos e Condições.");
      return;
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    const urlencoded = new URLSearchParams();
    urlencoded.append("idUserCategory", "1");
    urlencoded.append("name", nome);
    urlencoded.append("email", email);
    urlencoded.append("password", senha);
    urlencoded.append("phone", telefone);

    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: urlencoded,
      redirect: "follow"
    };

    fetch("http://localhost/Dona-Angela-Store-/api/Users/add", requestOptions)
      .then((response) => response.text())
      .then((result) => {
        console.log(result);
        alert("Cadastro realizado com sucesso!");
        // Redirecionar se quiser:
        // window.location.href = "login.html";
      })
      .catch((error) => {
        console.error("Erro ao cadastrar:", error);
        alert("Erro ao cadastrar usuário.");
      });
  });
});

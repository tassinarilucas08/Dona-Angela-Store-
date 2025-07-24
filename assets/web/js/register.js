const form = document.querySelector("#register");

form.addEventListener("click", (e) => {
  e.preventDefault(); // Impede o comportamento padrão

  const nome = document.querySelector("#nome").value;
  const email = document.querySelector("#email").value;
  const telefone = document.querySelector("#telefone").value;
  const senha = document.querySelector("#senha").value;
  const senhaConfirmar = document.querySelector("#senhaConfirmar").value;
  const termosAceitos = document.querySelector("#termos").checked;

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
    .then((response) => response.json())
    .then((result) => {
      console.log(result);
      if (result.status === "created") {
        alert(result.message || "Cadastro realizado com sucesso!");
        window.location.href = "/Dona-Angela-Store-/login";
      } else {
        alert(result.message || "Erro ao cadastrar usuário.");
      }
    })
    .catch((error) => {
      console.error("Erro ao cadastrar:", error);
      alert("Erro ao cadastrar usuário.");
    });
});
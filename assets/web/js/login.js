document.querySelector("#loginForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.querySelector("#email").value;
  const password = document.querySelector("#senha").value;

  const headers = new Headers();
  headers.append("Content-Type", "application/x-www-form-urlencoded");

  const body = new URLSearchParams();
  body.append("email", email);
  body.append("password", password);

  const options = {
    method: "POST",
    headers: headers,
    body: body,
    redirect: "follow"
  };

  try {
    const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/login", options);

    if (!response.ok) {
      throw new Error("Login falhou");
    }
    const data = await response.json(); // <- Aqui pega os dados do usuário
    localStorage.setItem("usuario", JSON.stringify(data));

    // Login ok → redireciona para a tela principal
    window.location.href = "/Dona-Angela-Store-/";
  } catch (error) {
    console.error("Erro no login:", error);
    alert("Email ou senha incorretos.");
  }
});
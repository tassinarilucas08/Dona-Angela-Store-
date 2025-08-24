const formReset = document.querySelector("#resetForm");

formReset.addEventListener("submit", async (e) => {
  e.preventDefault();

  const password = document.querySelector("#password").value;
  const confirmPassword = document.querySelector("#confirm-password").value;

  const urlParams = new URLSearchParams(window.location.search);
  const token = urlParams.get("token");

  if (!token) {
    alert("Token inválido ou ausente!");
    window.location.href = "/login";
    return;
  }

  if (!password || !confirmPassword) {
    alert("Preencha todos os campos!");
    return;
  }

  if (password !== confirmPassword) {
    alert("As senhas não coincidem!");
    return;
  }

  try {
    const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/updatePass", {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ token, password })
    });

    const data = await response.json();

    if (!response.ok) {
      alert(data.message || "Erro ao redefinir a senha");
      return;
    }

    alert("Senha redefinida com sucesso!");
    window.location.href = "Dona-Angela-Store-/login";

  } catch (err) {
    console.error("Erro de conexão:", err);
    alert("Erro de conexão com o servidor");
  }
});

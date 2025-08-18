// login.js
const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    alert("Preencha todos os campos!");
    return;
  }

  try {
    console.log(email, password);
    const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password }), // enviar senha em texto
    });

    const data = await response.json();

    if (!response.ok) {
      alert(data.message || "Erro ao fazer login");
      return;
    }

    // Salva o token e os dados do usuário no localStorage
    localStorage.setItem("userToken", data.data.token);
    localStorage.setItem("userData", JSON.stringify(data.data.user));

    alert("Login realizado com sucesso!");
    window.location.href = "/Dona-Angela-Store-/app"; // ou página principal

  } catch (error) {
    console.error("Erro ao conectar à API:", error);
    alert("Erro de conexão");
  }
});
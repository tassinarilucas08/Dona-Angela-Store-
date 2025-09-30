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
    if(data.data.user.idUserCategory == 1){
    window.location.href = "/Dona-Angela-Store-/app";} // ou página principal
    else if(data.data.user.idUserCategory == 3){
      window.location.href = "/Dona-Angela-Store-/admin"; // ou página principal
    }
    else{
      window.location.href = "/Dona-Angela-Store-/seller"; // ou página principal
    }

  } catch (error) {
    console.error("Erro ao conectar à API:", error);
    alert("Erro de conexão");
  }
});
document.addEventListener("DOMContentLoaded", () => {
  const togglePassword = document.querySelector(".toggle-password");
  const passwordInput = document.getElementById("password");

  togglePassword.addEventListener("click", () => {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      togglePassword.classList.remove("fa-eye");
      togglePassword.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      togglePassword.classList.remove("fa-eye-slash");
      togglePassword.classList.add("fa-eye");
    }
  });
});

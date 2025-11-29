// login.js
const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    M.Toast.dismissAll();
    M.toast({html: 'Preencha todos os campos!', classes: 'red rounded'});
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
      M.Toast.dismissAll();
      M.toast({html: data.message || 'Erro ao fazer login', classes: 'red rounded'});
      return;
    }

    // Salva o token e os dados do usuário no localStorage
    localStorage.setItem("userToken", data.data.token);
    localStorage.setItem("userData", JSON.stringify(data.data.user));

    M.Toast.dismissAll();
    M.toast({html: 'Login realizado com sucesso!', classes: 'green rounded'});
    
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
    M.Toast.dismissAll();
    M.toast({html: 'Erro de conexão com o servidor', classes: 'toast-custom rounded'});
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

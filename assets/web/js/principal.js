document.addEventListener("DOMContentLoaded", function () {
  const userData = localStorage.getItem("user");
  const loginLink = document.querySelector(".login-link");
  const perfilLink = document.querySelector(".perfil-link");
  const header = document.querySelector("header");
  const logoutBtn = document.getElementById("logoutBtn");

  if (userData) {
    const user = JSON.parse(userData);

    if (loginLink) {
      loginLink.style.display = "none";
    }

    const userNameDiv = document.createElement("div");
    userNameDiv.classList.add("nome-usuario-logado");
    userNameDiv.style.color = "#000";
    userNameDiv.style.fontWeight = "bold";
    userNameDiv.style.marginRight = "10px";
    userNameDiv.textContent = `Olá, ${user.name}`;
    header.insertBefore(userNameDiv, perfilLink);

    // Mostra o botão "Sair"
    logoutBtn.style.display = "inline-block";
  }
});

// Função para logout
function logout() {
  localStorage.removeItem("user");
  window.location.href = "login.html";
}
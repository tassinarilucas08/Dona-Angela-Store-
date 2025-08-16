// login.js

const loginForm = document.querySelector("#loginForm");

if (loginForm) {
  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = loginForm.querySelector("#email").value.trim();
    const password = loginForm.querySelector("#password").value.trim();

    try {
      const res = await fetch("/api/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password }),
      });

      const result = await res.json();

      if (res.ok) {
        alert("Login realizado com sucesso!");
        window.location.href = "/home"; // ajusta se tua rota for outra
      } else {
        alert(result.message || "Credenciais inválidas.");
      }
    } catch (err) {
      console.error(err);
      alert("Erro no servidor. Tente novamente mais tarde.");
    }
  });
}
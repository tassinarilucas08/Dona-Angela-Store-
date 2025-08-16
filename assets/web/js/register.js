// register.js

const registerForm = document.querySelector("#registerForm");

if (registerForm) {
  registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const name = registerForm.querySelector("#name").value.trim();
    const email = registerForm.querySelector("#email").value.trim();
    const phone = registerForm.querySelector("#phone").value.trim();
    const password = registerForm.querySelector("#password").value.trim();
    const idUserCategory = parseInt(registerForm.querySelector("#idUserCategory").value);

    try {
      const res = await fetch("/api/users/create", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, email, phone, password, idUserCategory }),
      });

      const result = await res.json();

      if (res.ok) {
        alert("Cadastro realizado com sucesso!");
        window.location.href = "/login";
      } else {
        alert(result.message || "Erro ao cadastrar usuário.");
      }
    } catch (err) {
      console.error(err);
      alert("Erro no servidor. Tente novamente mais tarde.");
    }
  });
}
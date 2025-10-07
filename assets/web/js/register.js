// register.js

const registerForm = document.querySelector("#registerForm");

if (registerForm) {
  registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const name = registerForm.querySelector("#name").value.trim();
    const email = registerForm.querySelector("#email").value.trim();
    const phone = registerForm.querySelector("#phone").value.trim();
    const password = registerForm.querySelector("#password").value.trim();
    const passwordConfirm = registerForm.querySelector("#password_confirm").value.trim();

    try {
      console.log({name, email, password, phone, passwordConfirm});
      const res = await fetch("http://localhost/Dona-Angela-Store-/api/Users/add", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({name, email, password, phone, passwordConfirm}),
      });

      const result = await res.json();

      if (res.ok) {
        alert("Cadastro realizado com sucesso!");
        window.location.href = "/Dona-Angela-Store-/confirm-email";
      } else {
        alert(result.message || "Erro ao cadastrar usuário.");
      }
    } catch (err) {
      console.error(err); 
      alert("Erro no servidor. Tente novamente mais tarde.");
  }
 });
}
document.addEventListener("DOMContentLoaded", () => {
  // pega todos os botões de toggle
  const toggles = document.querySelectorAll(".toggle-password, .toggle-password-confirm");

  toggles.forEach(toggle => {
    toggle.addEventListener("click", () => {
      // pega o input "irmão" do ícone
      const input = toggle.previousElementSibling;

      if (input.type === "password") {
        input.type = "text";
        toggle.classList.remove("fa-eye");
        toggle.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        toggle.classList.remove("fa-eye-slash");
        toggle.classList.add("fa-eye");
      }
    });
  });
});

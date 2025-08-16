// register.js

const registerForm = document.querySelector("#registerForm");

if (registerForm) {
  registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const name = registerForm.querySelector("#name").value.trim();
    const email = registerForm.querySelector("#email").value.trim();
    const phone = registerForm.querySelector("#phone").value.trim();
    const password = registerForm.querySelector("#password").value.trim();

    try {
      console.log({name, email, password, phone});
      const res = await fetch("http://localhost/Dona-Angela-Store-/api/Users/add", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({name, email, password, phone}),
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
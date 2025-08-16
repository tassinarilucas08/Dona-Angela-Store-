registerForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const name = registerForm.querySelector("#name").value;
  const email = registerForm.querySelector("#email").value;
  const phone = registerForm.querySelector("#phone").value;
  const password = registerForm.querySelector("#password").value;
  const passwordAgain = registerForm.querySelector("#passwordAgain").value;

  if(password !== passwordAgain){
    alert("As senhas não coincidem!");
    return;
  }

  try {
    const res = await fetch("http://localhost/Dona-Angela-Store-/api/Users/add", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ name, email, phone, password })
    });

    let result;
    try {
      result = await res.json();
    } catch(err) {
      // Se não conseguir ler como JSON
      console.error("Resposta inválida do servidor:", await res.text());
      alert("Erro no servidor. Resposta inválida.");
      return;
    }

    if (res.ok) {
      alert(result.message || "✅ Cadastro realizado com sucesso!");
      window.location.href = "/login";
    } else {
      alert(result.message || "Erro ao cadastrar usuário.");
    }

  } catch (err) {
    console.error("Erro no register.js:", err);
    alert("Erro no servidor. Tente novamente mais tarde.");
  }
});
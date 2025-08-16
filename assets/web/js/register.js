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

<<<<<<< HEAD
  try {
    const res = await fetch("http://localhost/Dona-Angela-Store-/api/Users/add", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ name, email, phone, password })
    });
=======
    const name = registerForm.querySelector("#name").value.trim();
    const email = registerForm.querySelector("#email").value.trim();
    const phone = registerForm.querySelector("#phone").value.trim();
    const password = registerForm.querySelector("#password").value.trim();
>>>>>>> beb6320dd036dc66d444b8e1d26ab1899a2fd93a

    let result;
    try {
<<<<<<< HEAD
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
=======
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
>>>>>>> beb6320dd036dc66d444b8e1d26ab1899a2fd93a

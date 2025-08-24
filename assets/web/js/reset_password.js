let buttonSend = document.querySelector("#enviar-link")

buttonSend.addEventListener("click", async(e)=>{
    e.preventDefault();

    let email = document.querySelector("#email").value;

  if (!email) {
    alert("Preencha todos os campos!");
    return;
  } 

  try {
    const response = await fetch("http://localhost/Dona-Angela-Store-/api/Users/sendEmail", {
      method: "POST",
      headers: { 
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ email}),
    });

    const data = await response.json();

    if (!response.ok) {
      alert(data.message || "Erro ao atualizar usuário");
      return;
    }

    alert("Verifique seu email");

  } catch (error) {
    console.error("Erro ao conectar à API:", error);
    alert("Erro de conexão");
  }
})

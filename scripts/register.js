document
  .getElementById("finish-button")
  .addEventListener("click", async (event) => {
    event.preventDefault();

    let usernameInput = document.getElementById("user-input");
    let emailInput = document.getElementById("email-input");
    let passwordInput = document.getElementById("pass-input");
    let confirmPasswordInput = document.getElementById("pass2-input");

    // Limpa espaços indesejados
    let username = usernameInput.value.trim();
    let email = emailInput.value.trim();
    let password = passwordInput.value.trim();
    let confirmPassword = confirmPasswordInput.value.trim();

    // Validar se as senhas coincidem
    if (password !== confirmPassword) {
      console.log("As senhas não coincidem");
      return;
    }

    // debug
    console.log("User = " + username + " | Email = " + email + " | Pass = " + password);

    if (username === "" || email === "" || password === "") {
      console.log("Preencha todos os campos obrigatórios");
    } else {
      console.log("Todos os campos preenchidos");
      try {
        // Chama a função para enviar os dados para a API
        await fazerRegistro(username, email, password);
      } catch (error) {
        console.error("Erro ao fazer registro:", error);
      }
    }
  });

// Função para fazer registro usando a API em PHP
async function fazerRegistro(username, email, password) {
  let dados = {
    username: username,
    email: email,
    password: password,
  };

  let dadosCodificados = btoa(JSON.stringify(dados));
  console.log('btoa = ' + dadosCodificados);

  let requestOptions = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: "Basic " + dadosCodificados,
    },
    body: JSON.stringify(dados),
  };

  try {
    let response = await fetch("../api_registro.php", requestOptions);

    // Verificar o tipo de conteúdo da resposta
    const contentType = response.headers.get("Content-Type");

    let responseData;

    if (contentType && contentType.includes("application/json")) {
      responseData = await response.json();
    } else {
      responseData = await response.text();
    }

    if (response.ok) {
      if (responseData.status) {
        console.log("Registro bem-sucedido:", responseData);
        // Adicionar aqui o código para redirecionar o usuário ou realizar outras ações após o registro bem-sucedido
      } else {
        console.log(responseData.mensagem);
      }
    } else {
      console.error("Erro na API:", responseData);
      // Adicionar aqui o código para lidar com erros de registro, como exibir uma mensagem de erro para o usuário
    }
  } catch (error) {
    console.error("Erro ao fazer registro:", error);
  }
}
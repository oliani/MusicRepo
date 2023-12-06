document
  .getElementById("login-button")
  .addEventListener("click", async (event) => {
    event.preventDefault();

    let usernameInput = document.getElementById("user");
    let passwordInput = document.getElementById("pass");

    // Limpa espaços indesejados
    let username = usernameInput.value.trim();
    let pass = passwordInput.value.trim();

    // debug
    console.log("User = " + username + " | Pass = " + pass);

    if (username === "") {
      console.log("Nome de usuário vazio");
    } else if (pass === "") {
      console.log("Senha vazia");
    } else {
      console.log("Usuário e senha preenchidos");
      try {
        // Chama a função para enviar os dados para a API
        await fazerLogin(username, pass);
      } catch (error) {
        console.error("Erro ao fazer login:", error);
      }
    }
  });

// Função para fazer login usando uma API em PHP
async function fazerLogin(username, password) {
  let dados = {
    username: username,
    password: password,
  };

  // let dadosCodificados = btoa(JSON.stringify(dados));
  // console.log('btoa = ' + dadosCodificados);

  let requestOptions = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: "Basic " ,
    },
    body: JSON.stringify(dados)
  };

  try {
    let response = await fetch("../api.php", requestOptions);

    // Verificar o tipo de conteúdo da resposta
    const contentType = response.headers.get("Content-Type");

    let responseData;

    if (contentType && contentType.includes("application/json")) {
      responseData = await response.json();
    } else {
      responseData = await response.text();
    }

    if (response.ok) {
      if (responseData.status){
        console.log("Login bem-sucedido:", responseData);
      } else {
        console.log(responseData.mensagem)
      }
      // Adicionar aqui o código para redirecionar o usuário ou realizar outras ações após o login bem-sucedido
    } else {
      console.error("Erro na API:", responseData);
      // Adicionar aqui o código para lidar com erros de login, como exibir uma mensagem de erro para o usuário
    }
  } catch (error) {
    console.error("Erro ao fazer login:", error);
  }
}
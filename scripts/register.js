document
 .getElementById("register-button")
 .addEventListener("click", async (event) => {
    event.preventDefault();

    console.log('oi');
    let usernameInput = document.getElementById("usuario");
    let emailInput = document.getElementById("email");
    let passwordInput = document.getElementById("senha");
    let confirmPasswordInput = document.getElementById("redsenha");

    // Limpa espaços indesejados
    let username = usernameInput.value.trim();
    let email = emailInput.value.trim();
    let password = passwordInput.value.trim();
    let confirmPassword = confirmPasswordInput.value.trim();

    // debug
    console.log("User = " + username + " | Email = " + email + " | Pass = " + password + " | Confirm Pass = " + confirmPassword);

    if (username === "" || email === "" || password === "" || confirmPassword === "") {
        console.log("Preencha todos os campos.");
    } else if (password !== confirmPassword) {
        console.log("Senhas não coincidem");
    } else {
        console.log("Todos os campos preenchidos corretamente");
        try {
            // Chama a função para enviar os dados para a API
            await realizarRegistro(username, email, password);
        } catch (error) {
            console.error("Erro ao realizar registro:", error);
        }
    }
});

// Função para realizar o registro usando uma API em PHP
async function realizarRegistro(username, email, password) {
    let dados = {
        username: username,
        email: email,
        password: password,
    };

    let requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: "Basic ",
        },
        body: JSON.stringify(dados),
    };

    try {
        let response = await fetch("../api_register.php", requestOptions);

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
                window.location.href = "../library/login.php";
            
            } else {
                console.log(responseData.mensagem);
            }
        } else {
            console.error("Erro na API:", responseData);
            // Adicionar aqui o código para lidar com erros de registro, como exibir uma mensagem de erro para o usuário
        }
    } catch (error) {
        console.error("Erro ao realizar registro:", error);
    }
}
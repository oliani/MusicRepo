    function validateLogin(){
        var username = document.getElementById('usuario').value;
        var password = document.getElementById('senha').value;

        // Construa os dados a serem enviados para a API
        var data = {
            username: username,
            password: password
        };

        // Faça a chamada AJAX
        fetch('api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            // Processar a resposta da API
            if (data.success) {
                // Login bem-sucedido, redirecione ou faça algo apropriado
                alert('Login bem-sucedido!');
            } else {
                // Login falhou, exiba uma mensagem de erro
                alert('Login falhou. Verifique suas credenciais.');
            }
        })
        .catch((error) => {
            console.error('Erro na requisição:', error);
        });
    }


<?php
include 'header.php';
?>
<link rel="stylesheet" href="../style/login.css">
<title>FreeMusic - Login</title>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6 bg-dark text-white">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="https://i.imgur.com/g9iXQsK.png" style="width: 300px;" alt="logo">
                                    </div>
                                    <form name="login-form" method="POST" onsubmit="validateLogin(); return false;">
                                        <p>Faça login em sua conta:</p>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="usuario" class="form-control" placeholder="nome de usuário" />
                                            <label class="form-label" for="usuario">Usuário</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="senha" class="form-control" placeholder="senha" />
                                            <label class="form-label" for="senha">Senha</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Entrar</button>
                                            <a class="text-muted" href="recovery.php">Esqueci minha senha...</a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Não tem uma conta?</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <button type="button" onclick="window.location.href='register.php'" class="btn btn-outline-success">Crie sua Conta</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">A sua biblioteca de músicas sem direitos autorais!</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    function calculateHash() {
        var inputString = document.getElementById('inputString').value;
        var hashResult = sha256(inputString);

        // Exibir resultados na página
        document.getElementById('resultString').innerText = inputString;
        document.getElementById('resultHash').innerText = hashResult;

        // Inserir o valor calculado no campo hidden antes de enviar o formulário
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'hashedString';
        hiddenInput.value = hashResult;
        document.getElementById('hashForm').appendChild(hiddenInput);

        // Enviar o formulário
        document.getElementById('hashForm').submit();
    }

    // Exemplo de função para calcular SHA-256 usando uma biblioteca externa (por exemplo, crypto-js)
    function sha256(input) {
        // Implementação do cálculo do hash SHA-256 usando a biblioteca crypto-js
        // Certifique-se de incluir a biblioteca no seu projeto
        // Exemplo de inclusão: <script src="https://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha256.js">
    }

    /** PHP: **/
    /*
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber a string e o hash do formulário
    $inputString = $_POST["inputString"];
    $hashedString = $_POST["hashedString"];

    // Verificar se o hash recebido é válido
    // Lembre-se de realizar a validação apropriada, dependendo dos requisitos do seu aplicativo

    // Agora você pode usar $inputString e $hashedString conforme necessário
}
?>

    */
</script>






</html>
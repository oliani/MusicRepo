<?php
header('Content-Type: application/json');

// Recebe os dados da requisição
$input = file_get_contents("php://input");
$data = json_decode($input);


// Extrai o nome de usuário e senha
$username = $data->username;
$password = $data->password;

// Verifica se os dados foram recebidos corretamente
if (!isset($data->username) || !isset($data->password)) {
    http_response_code(400);
    $mensagemErro = "Dados incompletos " . json_encode($data);
    error_log($mensagemErro);
    echo json_encode(array("mensagem" => "Dados incompletos"));
    exit();
}

// Converte os dados codificados usando base64_decode
$decodedData = json_decode(base64_decode($input));

// Conecta ao banco de dados (substitua 'root' e '' pelos valores reais do seu usuário e senha do PHPMyAdmin)
$mysqli = new mysqli("localhost", "root", "", "freemusic");

// Verifica a conexão
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(array("mensagem" => "Erro na conexão com o banco de dados."));
    exit();
}

// Escapa os dados para evitar SQL injection
$username = $mysqli->real_escape_string($decodedData->username);

// Consulta o banco de dados para obter as informações do usuário
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verifica se a senha está correta usando password_verify
    if (password_verify($decodedData->password, $user['password'])) {
        // Senha correta, login bem-sucedido
        http_response_code(200);
        echo json_encode(array("mensagem" => "Login bem-sucedido"));
    } else {
        // Senha incorreta
        http_response_code(401);
        echo json_encode(array("mensagem" => "Senha incorreta"));
    }
} else {
    // Usuário não encontrado
    http_response_code(404);
    echo json_encode(array("mensagem" => "Usuário não encontrado"));
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>

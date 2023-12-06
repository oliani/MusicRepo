<?php
header('Content-Type: application/json');

error_reporting(0);

// Recebe os dados da requisição
$input = file_get_contents("php://input");
$data = json_decode($input);

// Extrai os dados do formulário de registro
$username = $data->username;
$email = $data->email;
$password = $data->password;

// Verifica se os dados foram recebidos corretamente
if (!isset($data->username) || !isset($data->email) || !isset($data->password)) {
    http_response_code(400);
    $mensagemErro = "Dados incompletos " . json_encode($data);
    error_log($mensagemErro);
    echo json_encode(array("mensagem" => "Dados incompletos"));
    exit();
}

// Converte os dados codificados usando base64_decode (se necessário)
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
$username = $mysqli->real_escape_string($username);
$email = $mysqli->real_escape_string($email);

// Verifica se o usuário já existe
$queryCheckUser = "SELECT * FROM person WHERE username = '$username' OR email = '$email'";
$resultCheckUser = $mysqli->query($queryCheckUser);

if ($resultCheckUser->num_rows > 0) {
    // Usuário ou e-mail já existem
    http_response_code(409); // Conflito
    echo json_encode(array("mensagem" => "Usuário ou e-mail já existem", "status" => false));
    exit();
}

// Hash da senha
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insere o novo usuário no banco de dados
$queryInsertUser = "INSERT INTO person ('username', 'email', 'password') VALUES ('$username', '$email', '$passwordHash')";
$resultInsertUser = $mysqli->query($queryInsertUser);

if ($resultInsertUser) {
    // Registro bem-sucedido
    http_response_code(201); // Criado
    echo json_encode(array("mensagem" => "Registro bem-sucedido", "status" => true));
} else {
    // Erro ao inserir usuário
    http_response_code(500);
    echo json_encode(array("mensagem" => "Erro ao realizar registro: " . $mysqli->error, "status" => false));
}

// Fecha a conexão com o banco de dados
$mysqli->close();

?>
<?php
header('Content-Type: application/json');

error_reporting(0);

// Recebe os dados da requisição
$input = file_get_contents("php://input");
$data = json_decode($input);

// Extrai o nome de usuário, e-mail e senha
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
$username = $mysqli->real_escape_string($username);
$email = $mysqli->real_escape_string($email);

// Hash da senha
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Consulta o banco de dados para verificar se o usuário já existe
$query = "SELECT * FROM person WHERE username = '$username' OR email = '$email'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    // Usuário ou e-mail já existente
    http_response_code(409);
    echo json_encode(array("mensagem" => "Nome de usuário ou e-mail já cadastrado", "status" => false));
} else {
    // Insere os dados na tabela
    $insertQuery = "INSERT INTO person (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
    if ($mysqli->query($insertQuery)) {
        // Registro bem-sucedido
        http_response_code(201);
        echo json_encode(array("mensagem" => "Registro bem-sucedido", "status" => true));
    } else {
        // Erro ao inserir no banco de dados
        http_response_code(500);
        echo json_encode(array("mensagem" => "Erro ao registrar usuário", "status" => false));
    }
}

// Fecha a conexão com o banco de dados
/** Falta fazer a lógica de inserir a hash junto do usuário**/
$mysqli->close();
?>



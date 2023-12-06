<?php
header('Content-Type: application/json');

error_reporting(0);

// Recebe os dados da requisição
$input = file_get_contents("php://input");
$data = json_decode($input);

// Extrai os dados do formulário de adição de música
$title = $data->title;
$author = $data->author;
$path = $data->path;
$duration = $data->duration;
$extension = $data->extension;

// Verifica se os dados foram recebidos corretamente
if (!isset($data->title) || !isset($data->author) || !isset($data->path) || !isset($data->duration) || !isset($data->extension)) {
    http_response_code(400);
    echo json_encode(array("mensagem" => "Dados incompletos"));
    exit();
}

// Conecta ao banco de dados (substitua 'root' e '' pelos valores reais do seu usuário e senha do PHPMyAdmin)
$mysqli = new mysqli("localhost", "root", "", "seu_banco_de_dados");

// Verifica a conexão
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(array("mensagem" => "Erro na conexão com o banco de dados."));
    exit();
}

// Escapa os dados para evitar SQL injection
$title = $mysqli->real_escape_string($title);
$author = $mysqli->real_escape_string($author);
$path = $mysqli->real_escape_string($path);
$duration = $mysqli->real_escape_string($duration);
$extension = $mysqli->real_escape_string($extension);

// Insere a nova música no banco de dados
$queryInsertTrack = "INSERT INTO track (title, author, path, duration, extension) VALUES ('$title', '$author', '$path', '$duration', '$extension')";
$resultInsertTrack = $mysqli->query($queryInsertTrack);

if ($resultInsertTrack) {
    // Inserção bem-sucedida
    http_response_code(201); // Criado
    echo json_encode(array("mensagem" => "Música adicionada com sucesso", "status" => true));
} else {
    // Erro ao inserir música
    http_response_code(500);
    echo json_encode(array("mensagem" => "Erro ao adicionar música: " . $mysqli->error, "status" => false));
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>
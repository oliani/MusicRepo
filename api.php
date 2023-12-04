<?php

// Função para se conectar ao banco de dados
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "freemusic";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Estado da conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    return $conn;
}

// Verificar se a solicitação é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Pegando dados do corpo da solicitação
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar se os usuário e senha foram passados corretamente
    if (isset($data['username']) && isset($data['password'])) {

        // cria a conexão com o DB
        $conn = connectDB();

        // Prepara a consulta SQL
        $stmt = $conn->prepare("SELECT * FROM person WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $data['username'], $data['password']);
        $stmt->execute();

        // Obter resultados
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // auth ok
            $response = array('status' => 'success', 'message' => 'Autenticação OK');
        } else {
            // Falha de auth
            $response = array('status' => 'error', 'message' => 'Falhou na auth');
        }

        // Fechar a conexão
        $stmt->close();
        $conn->close();

    } else {
        // Falta usuário e senha
        $response = array('status' => 'error', 'message' => 'Usuário e/ou senha não informados');
    }

} else {
    // Método não suportado
    $response = array('status' => 'error', 'message' => 'Método não suportado - [use o método POST]');
}

// Definindo o header
header('Content-Type: application/json');

// resposta em json que volta oa cliente
echo json_encode($response);
?>
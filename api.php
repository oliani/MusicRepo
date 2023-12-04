<?php

include('/config/db_config.php');

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se a solicitação é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obter dados do corpo da solicitação
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar se os campos obrigatórios (username e password) estão presentes
    if (isset($data['username']) && isset($data['password'])) {

        // Consulta SQL para verificar as credenciais
        $query = "SELECT * FROM person WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $data['username'], $data['password']);
        $stmt->execute();

        // Obter resultados
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Autenticação bem-sucedida
            $response = array('status' => 'success', 'message' => 'Autenticação bem-sucedida');
        } else {
            // Falha na autenticação
            $response = array('status' => 'error', 'message' => 'Credenciais inválidas');
        }

        // Fechar a conexão e liberar recursos
        $stmt->close();

    } else {
        // Campos obrigatórios ausentes
        $response = array('status' => 'error', 'message' => 'Campos obrigatórios ausentes');
    }

    // Definir cabeçalhos para indicar que a resposta é JSON
    header('Content-Type: application/json');

    // Enviar resposta JSON ao cliente
    echo json_encode($response);

} else {
    // Método não suportado
    $response = array('status' => 'error', 'message' => 'Método não suportado');

    // Definir cabeçalhos para indicar que a resposta é JSON
    header('Content-Type: application/json');

    // Enviar resposta JSON ao cliente
    echo json_encode($response);
}

// Fechar a conexão
$conn->close();
?>
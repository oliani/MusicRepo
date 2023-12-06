<?php
header('Content-Type: application/json');

error_reporting(0);

// Conecta ao banco de dados
$mysqli = new mysqli("localhost", "root", "", "freemusic");

// Verifica a conexão
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(array("mensagem" => "Erro na conexão com o banco de dados."));
    exit();
}

// Consulta para obter o conteúdo da tabela TRACK
$query = "SELECT id, title, author, duration FROM TRACK";
$result = $mysqli->query($query);

if (!$result) {
    http_response_code(500);
    echo json_encode(array("mensagem" => "Erro na consulta ao banco de dados: " . $mysqli->error));
    exit();
}

// Inicializa um array para armazenar os resultados
$conteudoTracks = array();

// Processa os resultados da consulta
while ($row = $result->fetch_assoc()) {
    $conteudoTracks[] = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'author' => $row['author'],
        'duration' => $row['duration'],
    );
}

// Fecha a conexão com o banco de dados
$mysqli->close();

// Retorna os resultados como JSON
echo json_encode($conteudoTracks);
?>
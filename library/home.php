<?php
include 'header.php';

// Simulação de dados do banco. Substitua isso pela lógica real de consulta ao banco de dados.
$conteudoBanco = [
    ['title' => 'Música 1', 'author' => 'Autor 1', 'duration' => '3:30', 'path' => 'caminho/para/musica1.mp3'],
    ['title' => 'Música 2', 'author' => 'Autor 2', 'duration' => '4:15', 'path' => 'caminho/para/musica2.mp3'],
    // Adicione mais músicas conforme necessário
];
?>

<link rel="stylesheet" href="/style/home.css">
<script src="../scripts/home.js" defer></script>
<title>FreeMusic - Home</title>

<header class="bg-dark text-white p-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1>Free Music</h1>
        <span>Olá</span>
    </div>
</header>

<div class="container mt-3">
    <div class="row">
        <?php foreach ($conteudoBanco as $conteudo) : ?>
            <div class="col-md-5 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $conteudo['title']; ?></h5>
                        <p class="card-text">Autor: <?php echo $conteudo['author']; ?></p>
                        <p class="card-text text-muted">Duração: <?php echo $conteudo['duration']; ?></p>
                        <button class="btn btn-primary" onclick="baixarMusica('<?php echo $conteudo['path']; ?>')">Download</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
include 'header.php';
?>
<link rel="stylesheet" href="../style/home.css">
<script src="../scripts/home.js" defer></script>
<title>FreeMusic - Home</title>
<body>
    <header class="header bg-dark text-white p-2">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Free Music</h1>
        </div>
    </header>
    <div class="container mt-3">
        <div id="itens" class="row">
            <!-- Conteúdo dos itens da música -->
        </div>
        
        <!-- Botão para adicionar música -->
        <div class="text-center mt-3">
            <button class="btn btn-success" data-toggle="modal" data-target="#adicionarMusicaModal">Adicionar Música</button>
        </div>
    </div>

    <!-- Adicione o modal para adicionar música -->
    <div class="modal fade" id="adicionarMusicaModal" tabindex="-1" role="dialog" aria-labelledby="adicionarMusicaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adicionarMusicaModalLabel">Adicionar Música</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário para adicionar música -->
                    <!-- Substitua este formulário com o seu formulário de adição de música -->
                    <form>
                        <div class="form-group">
                            <label for="titulo">Título da Música</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Digite o título da música">
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input type="text" class="form-control" id="autor" placeholder="Digite o nome do autor">
                        </div>
                        <!-- Adicione outros campos conforme necessário -->
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
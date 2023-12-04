    <?php
    include './library/header.php';
    if (true) { // verificar se o usuário está logado, caso não estiver redireciona para o login
      header('Location: ./library/login.php');
    }
    ?>
    

    </html>
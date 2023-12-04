<?php
include 'header.php';
?>
<link rel="stylesheet" href="../style/login.css">
<title>FreeMusic - Register</title>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6 bg-dark text-white">
                                <div class="card-body p-md-5 mx-md-4">
                                    <form name="login-form">
                                        <H3>Cadastrar nova conta:</H3>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example11" class="form-control" placeholder="nome de usuário" />
                                            <label class="form-label" for="form2Example11">Usuário</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example11" class="form-control" placeholder="seu@email.com.br" />
                                            <label class="form-label" for="form2Example11">E-mail</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example22" class="form-control" placeholder="******" />
                                            <label class="form-label" for="form2Example22">Senha</label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example22" class="form-control" placeholder="******" />
                                            <label class="form-label" for="form2Example22">Redigite sua senha</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Concluir</button>
                                            <a class="text-muted" href="login.php"> < Voltar para tela de login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <img src="https://i.imgur.com/g9iXQsK.png" style="width: 300px;" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
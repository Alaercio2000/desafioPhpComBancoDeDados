<?php
session_start();

if (!empty($_SESSION['id'])) {
    header("Location: index.php");
}

require('functions/functions.php');

$erroLogin = false;
$erroEmail = false;
$erroSenha = false;

if ($_POST) {

    if (empty($_POST['email-login'])) {
        $erroEmail = true;
    }

    if (strlen($_POST['senha-login']) < 6) {
        $erroSenha = true;
    }

    if (!$erroEmail && !$erroSenha) {

        $email = $_POST['email-login'];
        $senha = $_POST['senha-login'];

        $id = loginUser($email, $senha);

        if (!empty($id)) {
            $_SESSION['id'] = $id;
            header("Location: index.php");
        } else {
            $erroLogin = true;
        }
    }
}

require("header/header.php");

?>

<div class="container mt-5">
    <h3 class="text-center py-5">Seja Bem-vindo</h3>
    <div class="row justify-content-center">
        <div class="col-6">
            <form method="post">
                <div class="form-group">
                    <label for="email" class="pl-2">Email</label>
                    <input required type="email" class="form-control <?= ($erroEmail) ? "is-invalid" : ""; ?>" name="email-login" id="email" placeholder="Digite seu email">
                    <div class="invalid-feedback pl-2">
                        Email invalido
                    </div>
                </div>
                <div class="form-group">
                    <label for="senha" class="pl-2">Senha</label>
                    <input required type="password" class="form-control <?= ($erroSenha) ? "is-invalid" : ""; ?>" name="senha-login" id="senha" placeholder="Digite seu email">
                    <div class="invalid-feedback pl-2">
                        Senha deve ter mais de 6 caracteres
                    </div>
                </div>
                <div class="d-none alert alert-danger alert-dismissible fade show <?= ($erroLogin) ? "d-block" : "" ?>" role="alert">
                    Email ou senha invalido
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100 mt-3">Entrar</button>
                </div>
                <h5 class="py-4 pl-3">Não tem cadastro ?<a class="pl-2" href="createUser.php">Cadastro</a></h5>
            </form>
        </div>
    </div>
</div>

</body>

</html>
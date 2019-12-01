<?php
session_start();

if (!$_SESSION['id']) {
    header("Location: login.php");
}

$erroEmail = false;
$erroEmailRep = false;
$erroSenha = false;
$erroNome = false;
$erroSenhaConf = false;
$checkEmail = false;
$erroSenhaAntiga = false;


require("functions/functions.php");

$id = base64_decode($_GET['id']);

$user = loadUsers();

foreach ($user as $value) {
    if ($value['id'] == $id) {
        $nome = $value['nome'];
        $email = $value['email'];
        $senhaAntiga = $value['senha'];
    }
}

if ($_POST) {

    if (empty($_POST['nome'])) {
        $erroNome = true;
    }

    if (empty($_POST['email'])) {
        $erroEmail = true;
    }

    if (!empty($_POST['senha'])) {
        if (strlen($_POST['senha']) > 5) {
            if ($_POST['senha'] == $_POST['senha-conf']) {
                $senhaNova = $_POST['senha'];
            } else {
                $erroSenhaConf = true;
            }
        } else {
            $erroSenha = true;
        }
    }

    if (!$erroEmail) {
        $checkEmail =  checkEmail($_POST['email']);
    }

    if ($_POST['email'] == $email) {
        $checkEmail = false;
    } else {
        if ($checkEmail) {
            $erroEmailRep = true;
        }
    }

    if (password_verify($_POST['senha-antiga'],$senhaAntiga)) {
        if (!empty($senhaNova)) {
            if (!$erroNome && !$erroEmail && !$checkEmail) {
                $nomeUp = $_POST['nome'];
                $emailUp = $_POST['email'];
                $senhaNova = password_hash($senhaNova, PASSWORD_DEFAULT);
                updateUser($nomeUp , $emailUp , $senhaNova , $id);
                header("Location: index.php");
            }   
        }else {
            if (!$erroNome && !$erroEmail && !$checkEmail) {
                $nomeUp = $_POST['nome'];
                $emailUp = $_POST['email'];
                updateUser($nomeUp , $emailUp , $senhaAntiga , $id);
                header("Location: index.php");
            }
        }
    }else {
        $erroSenhaAntiga = true;
    }

}

require("header/header.php");
?>

<div class="container">
    <h3 class="text-center py-5">Atualizando Usuário</h3>
    <div class="row justify-content-center">
        <div class="col-6">
            <form method="post">

                <div class="form-group">
                    <label for="nome" class="pl-2">Nome</label>
                    <input required type="text" class="form-control <?= ($erroNome) ? "is-invalid" : ""; ?>" name="nome" id="nome" placeholder="Digite seu nome" value="<?= $nome ?>">
                    <div class="invalid-feedback pl-2">
                        Nome invalido
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="pl-2">Email</label>
                    <input required type="email" class="form-control <?= ($erroEmail) ? "is-invalid" : ""; ?>" name="email" id="email" placeholder="Digite seu email" value="<?= $email ?>">
                    <div class="invalid-feedback pl-2">
                        Email invalido
                    </div>
                    <div class="d-none alert alert-warning alert-dismissible fade show mt-3 <?= ($erroEmailRep) ? "d-block" : ""; ?>" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        Esse email já foi cadastrado
                    </div>
                </div>
                <div class="form-group">
                    <label for="senha" class="pl-2">Nova senha</label>
                    <input type="password" class="form-control <?= ($erroSenha) ? "is-invalid" : ""; ?>" name="senha" id="senha" placeholder="Digite sua nova senha">
                    <div class="invalid-feedback pl-2">
                        Senha invalida , a senha deve ter mais de 6 caracteres
                    </div>
                </div>
                <div class="form-group">
                    <label for="senhaConf" class="pl-2">Confirme sua senha</label>
                    <input type="password" class="form-control <?= ($erroSenhaConf) ? "is-invalid" : ""; ?>" name="senha-conf" id="senhaConf" placeholder="Digite novamente sua senha">
                    <div class="invalid-feedback pl-2">
                        As senhas não coincidem
                    </div>
                </div>
                <div class="form-group">
                    <label for="senhaAntiga" class="pl-2">Digite sua senha antiga</label>
                    <input required type="password" class="form-control <?= ($erroSenhaAntiga) ? "is-invalid" : ""; ?>" name="senha-antiga" id="senhaAntiga" placeholder="Digite sua senha para validar as alterações">
                    <div class="invalid-feedback pl-2">
                        Senha invalida
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100 mt-3">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
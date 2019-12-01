<?php
session_start();

if (!$_SESSION['id']) {
    header("Location: login.php");
}else{
    $id = $_SESSION['id'];
}

require("functions/functions.php");

$erroNome = false;
$erroPreco = false;
$erroImg = false;

if (!empty($_POST)) {

    if (empty($_POST['nome'])) {
        $erroNome = true;
    }

    if (empty($_POST['preco'])) {
        $erroPreco = true;
    }
    if (($_FILES['imagem']['error']) != 0) {
        $erroImg = true;
    }

    if (!empty($_POST['descricao'])) {
        $descricao = $_POST['descricao'];
    } else {
        $descricao = "";
    }

    if (!$erroNome && !$erroPreco && !$erroImg) {
        $nomeImg = base64_encode(rand(0, 9999)) . $_FILES['imagem']['name'];

        move_uploaded_file($_FILES['imagem']['tmp_name'], 'img/' . $nomeImg);
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];

        newProduct($nome, $preco, $nomeImg, $descricao , $id);
        header("Location: index.php?filtro=2");
    }
}


require("header/header.php");
?>

<div class="container">
    <h2 class="text-center pt-4">Adicionar Produtos</h2>
    <div class="row justify-content-center">
        <form method="POST" class="col-6" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nameProduct">Nome Produto</label>
                <input required type="text" class="form-control <?= ($erroNome === true) ? "is-invalid" : ""; ?>" name="nome" id="nameProduct" placeholder="Digite o nome do produto">
                <div class="invalid-feedback pl-2">
                    Digite o nome do seu produto
                </div>
            </div>
            <div class="form-group">
                <label for="descriptionProduct">Descrição do produto</label>
                <textarea class="form-control" name="descricao" id="descriptionProduct" rows="10" placeholder="Digite mais a respeito do produto"></textarea></textarea>
            </div>
            <div class="form-group">
                <label for="priceProduct">Preço</label>
                <input required type="number" class="form-control <?= ($erroPreco === true) ? "is-invalid" : ""; ?>" name="preco" id="priceProduct" placeholder="Digite o preço do produto">
                <div class="invalid-feedback pl-2">
                    Digite o preço do seu produto
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="d-block">Escolhar sua imagem</label>
                <input id="image" required type="file" name="imagem">
            </div>
            <div class="d-none alert alert-danger alert-dismissible fade show <?= ($erroImg === true) ? "d-block" : "" ?>" role="alert">
                Não tem foto selecionada!!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <button type="submit" class="btn btn-secondary w-100 my-3">Cadastrar</button>
        </form>
    </div>
</div>


</body>

</html>
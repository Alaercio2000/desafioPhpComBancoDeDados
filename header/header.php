<?php
$filtroValor = 1;
if (!empty($_GET['filtro']))
    $filtroValor = $_GET['filtro'];
?>
<!doctype html>
<html lang="pt-br">

<head>

    <title>Desafio PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script defer src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        .menu {
            list-style: none;
        }
    </style>
</head>

<body>
    <?php if (!empty($_SESSION['id'])) : ?>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand font-weight-bold px-0 px-lg-5 px-md-3 text-primary" href="index.php<?= ($filtroValor == 2) ? '?filtro=2' : ''; ?>">Desafio Estruturado</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav w-100 d-flex justify-content-around">
                <a class="nav-link" href="createUser.php">Cadastrar Usuários</a>
                <a class="nav-link" href="createProducts.php">Cadastrar Produtos</a>
                <a class="nav-link" href="logout.php">Deslogar</a>
                </div>
            </div>
        </nav>

    <?php endif ?>
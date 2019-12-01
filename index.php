<?php

session_start();

require("functions/functions.php");

$users = loadUsers();
$products = loadProducts();

if (!$_SESSION['id']) {
  header("Location: login.php");
}

$filtroValor = 1;

if (!empty($_GET['filtro'])) {
  $filtroValor = $_GET['filtro'];
}


require("header/header.php");
?>

<style>
  .conteudoTable {
    max-height: 600px;
    overflow: auto;
  }
  .corpo{
    overflow: hidden;
  }
  .buttonResposive{
    width: 280px;
  }
  #tableProduct{
    min-width: 1000px;
  }
</style>

<div class="container corpo">

  <h3 class="pt-2">Olá , <?= nameUser($_SESSION['id']) ?></h3>

  <h2 class="pt-3 pb-1 text-center">Visão Geral</h2>

  <form method="GET" class="row justify-content-center mt-4">
    <select name="filtro" onChange="this.form.submit()">
      <option value="1" <?= ($filtroValor == "1") ? "selected='selected'" : ""; ?>>Ver Usuários</option>
      <option value="2" <?= ($filtroValor == "2") ? "selected='selected'" : ""; ?>>Ver Produtos</option>
    </select>
  </form>
  <div class="table-resposive mt-4 conteudoTable d-none <?= ($filtroValor != 2) ? "d-block" : ""; ?>">
    <table class="table table-bordered text-center">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Opcões</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user) : ?>

          <tr>
            <td><?= $user['nome'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
              <a href="editUser.php?id=<?= base64_encode($user['id']) ?>" class="btn btn-warning m-1">Editar</a>
              <a href="deleteUser.php?id=<?= base64_encode($user['id']) ?>" class="btn btn-danger m-1">Excluir</a>
            </td>
          </tr>

        <?php endforeach ?>
      </tbody>
    </table>
  </div>

  <div class="table-resposive mt-3 conteudoTable d-none <?= ($filtroValor == 2) ? "d-block" : ""; ?>">

    <table id="tableProduct" class="table table-bordered text-center align-items-center">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Preço</th>
          <th>Imagem</th>
          <th>Opcões</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($products as $product) : ?>

          <tr>
            <td class="pt-4 px-1"><?= $product['nome_produto'] ?></td>
            <td class="pt-4 px-1"><?=mb_strimwidth($product['descricao_produto'] , 0 , 50 , "...")?></td>
            <td class="pt-4 px-1">R$ <?= $product['preco'] ?></td>
            <td class="pt-3 px-1"><img src="img/<?= $product['imagem_produto'] ?>" height="50"></td>
            <td class="buttonResposive pt-3">
              <a class="btn btn-info" href="showProduct.php?id=<?= base64_encode($product['id']) ?>">Ver Mais</a>
              <a href="editProduct.php?id=<?= base64_encode($product['id']) ?>" class="btn btn-warning m-1">Editar</a>
              <a href="deleteProduct.php?id=<?=base64_encode($product['id']) ?>" class="btn btn-danger m-1">Excluir</a>
            </td>
          </tr>

        <?php endforeach ?>

      </tbody>
    </table>
  </div>

</div>

</body>

</html>
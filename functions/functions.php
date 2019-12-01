<?php

$dbName = "desafio";
$db = "mysql:dbname=$dbName;host=127.0.0.1";
$dbUser = "root";
$dbPass = "";

try {
    $pdo = new PDO($db, $dbUser, $dbPass);
} catch (PDOException $e) {
    header("Location: createBank/scriptBank.php");
}

// FUNÇÕES FEITAS EM USUÁRIOS


// FUNÇÃO PARA CARREGAR OS USUÁRIOS CADASTRADO

function loadUsers()
{
    global $pdo;
    $sql = $pdo->query("SELECT * FROM usuarios;");
    return $sql->fetchAll();
}

// FUNÇÃO PARA CADASTRO DE USUÁRIO

function newUser($nome, $email, $senha)
{
    global $pdo;

    $sql = "INSERT INTO usuarios (nome,email,senha) VALUES (:nome,:email,:senha)";
    $sql = $pdo->prepare($sql);
    $sql->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT)
    ]);
}

// VERIFICANDO SE O EMAIL DO USUÁRIO NÃO É REPETIDO

function checkEmail($email)
{
    $createdUsers = loadUsers();
    foreach ($createdUsers as $user) {
        if ($user['email'] == $email) {
            return true;
        }
    }
}

// FUNÇÃO PARA VALIDAR A ENTRADA DO USUÁRIO

function loginUser($email, $senha)
{
    $createdUsers = loadUsers();

    foreach ($createdUsers as $users) {
        if ($users['email'] == $email && password_verify($senha, $users['senha'])) {
            return $users['id'];
        }
    }
}

// FUNÇÃO PARA EDITAR USUÁRIO

function updateUser($nome, $email, $senha, $id)
{
    global $pdo;
    $sql = "UPDATE usuarios SET nome = :nome , email = :email , senha = :senha WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha,
        ':id' => $id
    ]);
}

// FUNÇÃO PARA PEGAR NOME DO USUÁRIO QUE ENTROU

function nameUser($id)
{
    $createdUsers = loadUsers();

    foreach ($createdUsers as $user) {
        if ($user['id'] == $id) {
            return $user['nome'];
        }
    }
}
function deleteUser($id)
{
    global $pdo;

    $sql = "DELETE FROM usuarios WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->execute([
        ':id' => $id
    ]);
}

// FUNÇÕES EM PRODUTOS

// CARREGAR ARQUIVOS JSON COM TODOS OS PRODUTOS

function loadProducts()
{
    global $pdo;
    $sql = "SELECT * , usuarios.nome AS nome_criador FROM produtos INNER JOIN usuarios ON produtos.usuarios_id=usuarios.id";
    $sql = $pdo->query($sql);
    return $sql->fetchAll();
}

// FUNÇÃO PARA CADASTRAR UM NOVO PRODUTO

function newProduct($nomeProd, $preco, $imagem, $descricao, $idUser)
{
    global $pdo;

    $sql = "INSERT INTO produtos 
                (nome_produto,descricao_produto,preco,imagem_produto,data_criacao,usuarios_id)
            VALUES
                (:nome,:descricao,:preco,:imagem,NOW(),:user);
     ";

    $sql = $pdo->prepare($sql);
    $sql->execute([
        ':nome' => $nomeProd,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':imagem' => $imagem,
        ':user' => $idUser
    ]);
}

// FUNÇÃO PARA EDITAR PRODUTO

function upProducts($nome, $preco, $imagem, $descricao, $id)
{
    global $pdo;

    $sql = "UPDATE produtos SET nome_produto = :nome , descricao_produto = :descricao , preco = :preco,imagem_produto = :imagem
    WHERE id = :id;
    ";

    $sql = $pdo->prepare($sql);
    $sql->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':imagem' => $imagem,
        ':id' => $id
    ]);
}

function deleteProduct($id)
{
    global $pdo;

    $sql = "DELETE FROM produtos WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->execute([
        ':id' => $id
    ]);
}

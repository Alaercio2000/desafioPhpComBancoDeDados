<?php

$db = "mysql:dbname=phpmyadmin;host=127.0.0.1";
$dbUser = "root";
$dbPass = "";

try {
    $pdo = new PDO($db,$dbUser,$dbPass);
    $sql = "

    CREATE DATABASE desafio;
    USE desafio;
    CREATE TABLE `produtos` (
        `id` int(10) NOT NULL,
        `nome_produto` varchar(80) NOT NULL,
        `descricao_produto` text DEFAULT NULL,
        `preco` int(10) NOT NULL,
        `imagem_produto` varchar(80) NOT NULL,
        `data_criacao` datetime NOT NULL,
        `usuarios_id` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      
      CREATE TABLE `usuarios` (
        `id` int(10) NOT NULL,
        `nome` varchar(80) DEFAULT NULL,
        `email` varchar(80) DEFAULT NULL,
        `senha` varchar(80) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      
      ALTER TABLE `produtos`
        ADD PRIMARY KEY (`id`),
        ADD KEY `usuarios_id` (`usuarios_id`);
      
      ALTER TABLE `usuarios`
        ADD PRIMARY KEY (`id`);
      
      ALTER TABLE `produtos`
        MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
      
      ALTER TABLE `usuarios`
        MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
      
      ALTER TABLE `produtos`
        ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);
      COMMIT;
    ";
    $sql = $pdo->query($sql);
    
    header("Location: ../index.php");
} catch (PDOException $e) {
    echo ("Não foi");
}

?>
<?php

session_start();

require("functions/functions.php");

if (!$_SESSION['id']) {
    header("Location: login.php");
}

$id = base64_decode($_GET['id']);

deleteUser($id);

header("Location: index.php?filtro=1");




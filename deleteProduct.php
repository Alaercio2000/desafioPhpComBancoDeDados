<?php

session_start();

require("functions/functions.php");

if ($_SESSION['id']) { } else {
    header("Location: login.php");
}

$id = base64_decode($_GET['id']);

deleteProduct($id);

header("Location: index.php?filtro=2");

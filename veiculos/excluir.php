<?php

require_once "../includes/verifica_login.php";
require_once "../config/conexao.php";

$id = $_GET["id"];

mysqli_query($conn,"DELETE FROM veiculos WHERE id=$id");

header("Location: listar.php");
exit();
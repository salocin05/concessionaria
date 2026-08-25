<?php
require_once "../includes/verifica_login.php";
require_once "../config/conexao.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "DELETE FROM proprietarios WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);
}

header("Location: listar.php");
exit();
?>
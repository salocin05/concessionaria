<?php

$host = "localhost";
$usuario = "root";
$senha = "pucpr";
$banco = "concessionaria";

$conn = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>
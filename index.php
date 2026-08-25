<?php
require_once "includes/verifica_login.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">

<title>Concessionária</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="index.php">
Concessionária
</a>

<div>

<a href="proprietarios/listar.php" class="btn btn-outline-light me-2">
Proprietários
</a>

<a href="veiculos/listar.php" class="btn btn-outline-light me-2">
Veículos
</a>

<a href="logout.php" class="btn btn-danger">
Sair
</a>

</div>

</div>

</nav>

<div class="container mt-5">

<h1 class="mb-4">

Bem-vindo ao Sistema da Concessionária

</h1>

<div class="row">

<div class="col-md-6">

<div class="card shadow">

<div class="card-body">

<h3>👤 Proprietários</h3>

<p>Cadastro e gerenciamento dos proprietários.</p>

<a href="proprietarios/listar.php" class="btn btn-primary">

Acessar

</a>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card shadow">

<div class="card-body">

<h3>🚗 Veículos</h3>

<p>Cadastro e gerenciamento dos veículos.</p>

<a href="veiculos/listar.php" class="btn btn-success">

Acessar

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
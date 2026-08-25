<?php
require_once "config/conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome,email,senha)
            VALUES (?,?,?)";

    $stmt = mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt,"sss",$nome,$email,$senha);

    if(mysqli_stmt_execute($stmt)){
        $mensagem = "Usuário cadastrado com sucesso!";
    }else{
        $mensagem = "Erro ao cadastrar usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Cadastro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h3>Cadastro de Usuário</h3>

</div>

<div class="card-body">

<?php

if($mensagem!=""){
    echo "<div class='alert alert-info'>$mensagem</div>";
}

?>

<form method="post">

<div class="mb-3">

<label>Nome</label>

<input
type="text"
name="nome"
class="form-control"
required>

</div>

<div class="mb-3">

<label>E-mail</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Senha</label>

<input
type="password"
name="senha"
class="form-control"
required>

</div>

<button class="btn btn-success">
Cadastrar
</button>

<a href="login.php"
class="btn btn-secondary">
Login
</a>

</form>

</div>

</div>

</div>

</body>

</html>
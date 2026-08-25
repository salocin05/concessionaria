<?php
session_start();
require_once "config/conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($usuario = mysqli_fetch_assoc($resultado)) {

        if (password_verify($senha, $usuario["senha"])) {

            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nome"] = $usuario["nome"];

            header("Location: index.php");
            exit;

        } else {
            $erro = "Senha incorreta.";
        }

    } else {

        $erro = "Usuário não encontrado.";

    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3>Login</h3>

</div>

<div class="card-body">

<?php
if($erro!=""){
echo "<div class='alert alert-danger'>$erro</div>";
}
?>

<form method="post">

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

<button class="btn btn-primary w-100">

Entrar

</button>

</form>

<br>

<a href="cadastro.php">

Criar uma conta

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
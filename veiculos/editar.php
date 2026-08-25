<?php
require_once "../includes/verifica_login.php";
require_once "../config/conexao.php";

$id = $_GET["id"];

// Busca o veículo
$sql = "SELECT * FROM veiculos WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$veiculo = mysqli_fetch_assoc($resultado);

// Atualiza o veículo
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $modelo = trim($_POST["modelo"]);
    $marca = trim($_POST["marca"]);
    $ano = $_POST["ano"];
    $placa = strtoupper(trim($_POST["placa"]));
    $proprietario = $_POST["proprietario"];

    $sql = "UPDATE veiculos
            SET modelo = ?,
                marca = ?,
                ano = ?,
                placa = ?,
                proprietario_id = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssisii",
        $modelo,
        $marca,
        $ano,
        $placa,
        $proprietario,
        $id
    );

    mysqli_stmt_execute($stmt);

    header("Location: listar.php");
    exit();
}

$proprietarios = mysqli_query(
    $conn,
    "SELECT * FROM proprietarios ORDER BY nome"
);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Editar Veículo</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/style.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="../index.php">
Concessionária
</a>

<div>

<a href="../proprietarios/listar.php" class="btn btn-outline-light me-2">
Proprietários
</a>

<a href="../veiculos/listar.php" class="btn btn-outline-light me-2">
Veículos
</a>

<a href="../logout.php" class="btn btn-danger">
Sair
</a>

</div>

</div>

</nav>

<div class="container mt-4">

<div class="card">

<div class="card-header bg-warning">

<h3>Editar Veículo</h3>

</div>

<div class="card-body">

<form method="post">

<div class="mb-3">

<label class="form-label">Modelo</label>

<input
type="text"
name="modelo"
class="form-control"
maxlength="50"
value="<?= $veiculo["modelo"] ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Marca</label>

<input
type="text"
name="marca"
class="form-control"
maxlength="50"
value="<?= $veiculo["marca"] ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Ano</label>

<input
type="number"
name="ano"
class="form-control"
min="1950"
max="2035"
value="<?= $veiculo["ano"] ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Placa</label>

<input
type="text"
name="placa"
class="form-control"
maxlength="8"
pattern="[A-Za-z]{3}[0-9][A-Za-z0-9][0-9]{2}"
style="text-transform: uppercase;"
value="<?= $veiculo["placa"] ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Proprietário</label>

<select
name="proprietario"
class="form-select"
required>

<?php while ($p = mysqli_fetch_assoc($proprietarios)) { ?>

<option
value="<?= $p["id"] ?>"
<?= $p["id"] == $veiculo["proprietario_id"] ? "selected" : "" ?>>

<?= $p["nome"] ?>

</option>

<?php } ?>

</select>

</div>

<button
type="submit"
class="btn btn-warning">

Salvar Alterações

</button>

<a
href="listar.php"
class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</div>

</div>

<footer class="bg-dark text-white text-center p-3 mt-5">

Sistema de Concessionária © 2026

</footer>

</body>

</html>
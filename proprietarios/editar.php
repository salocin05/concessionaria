<?php
require_once "../includes/verifica_login.php";
require_once "../config/conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM proprietarios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$proprietario = mysqli_fetch_assoc($resultado);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $telefone = trim($_POST["telefone"]);
    $email = trim($_POST["email"]);

    $sql = "UPDATE proprietarios
            SET nome = ?, telefone = ?, email = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssi",
        $nome,
        $telefone,
        $email,
        $id
    );

    mysqli_stmt_execute($stmt);

    header("Location: listar.php");
    exit();
}

require_once "../includes/header.php";
?>

<div class="container mt-4">

    <div class="card">

        <div class="card-header bg-warning">
            <h3>Editar Proprietário</h3>
        </div>

        <div class="card-body">

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Nome</label>

                    <input
                        type="text"
                        name="nome"
                        class="form-control"
                        maxlength="100"
                        value="<?= $proprietario["nome"] ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefone</label>

                    <input
                        type="tel"
                        name="telefone"
                        class="form-control"
                        pattern="[0-9]{10,11}"
                        value="<?= $proprietario["telefone"] ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">E-mail</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= $proprietario["email"] ?>"
                        required>
                </div>

                <button type="submit" class="btn btn-warning">
                    Salvar Alterações
                </button>

                <a href="listar.php" class="btn btn-secondary">
                    Cancelar
                </a>

            </form>

        </div>

    </div>

</div>

<?php
require_once "../includes/footer.php";
?>
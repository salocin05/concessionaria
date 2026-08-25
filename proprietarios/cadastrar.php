<?php
require_once "../includes/verifica_login.php";
require_once "../config/conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $telefone = trim($_POST["telefone"]);
    $email = trim($_POST["email"]);

    $sql = "INSERT INTO proprietarios (nome, telefone, email)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nome, $telefone, $email);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: listar.php");
        exit();
    } else {
        $mensagem = "Erro ao cadastrar proprietário.";
    }
}

require_once "../includes/header.php";
?>

<div class="container mt-4">

    <div class="card">

        <div class="card-header bg-success text-white">
            <h3>Novo Proprietário</h3>
        </div>

        <div class="card-body">

            <?php if ($mensagem != "") { ?>
                <div class="alert alert-danger">
                    <?= $mensagem ?>
                </div>
            <?php } ?>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input
                        type="text"
                        name="nome"
                        class="form-control"
                        maxlength="100"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefone</label>
                    <input
                        type="tel"
                        name="telefone"
                        class="form-control"
                        pattern="[0-9]{10,11}"
                        placeholder="41999998888"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required>
                </div>

                <button type="submit" class="btn btn-success">
                    Salvar
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
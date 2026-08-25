<?php
require_once "../includes/verifica_login.php";
require_once "../config/conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $modelo = trim($_POST["modelo"]);
    $marca = trim($_POST["marca"]);
    $ano = $_POST["ano"];
    $placa = strtoupper(trim($_POST["placa"]));
    $proprietario = $_POST["proprietario"];

    $sql = "INSERT INTO veiculos
            (modelo, marca, ano, placa, proprietario_id)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssisi",
        $modelo,
        $marca,
        $ano,
        $placa,
        $proprietario
    );

    if (mysqli_stmt_execute($stmt)) {

        header("Location: listar.php");
        exit();

    } else {

        $mensagem = "Erro ao cadastrar veículo.";

    }
}

$prop = mysqli_query($conn, "SELECT * FROM proprietarios ORDER BY nome");

require_once "../includes/header.php";
?>

<div class="container mt-4">

    <div class="card">

        <div class="card-header bg-success text-white">
            <h3>Novo Veículo</h3>
        </div>

        <div class="card-body">

            <?php if ($mensagem != "") { ?>

                <div class="alert alert-danger">

                    <?= $mensagem ?>

                </div>

            <?php } ?>

            <form method="post">

                <div class="mb-3">

                    <label class="form-label">Modelo</label>

                    <input
                        type="text"
                        name="modelo"
                        class="form-control"
                        maxlength="50"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Marca</label>

                    <input
                        type="text"
                        name="marca"
                        class="form-control"
                        maxlength="50"
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
                        placeholder="ABC1D23"
                        style="text-transform: uppercase;"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Proprietário</label>

                    <select
                        name="proprietario"
                        class="form-select"
                        required>

                        <?php while ($p = mysqli_fetch_assoc($prop)) { ?>

                            <option value="<?= $p["id"] ?>">

                                <?= $p["nome"] ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Salvar

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

<?php
require_once "../includes/footer.php";
?>
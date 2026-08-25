<?php
require_once "../includes/verifica_login.php";
require_once "../config/conexao.php";

$sql = "SELECT * FROM proprietarios ORDER BY nome";
$resultado = mysqli_query($conn, $sql);

require_once "../includes/header.php";
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Proprietários</h2>

        <a href="cadastrar.php" class="btn btn-success">
            Novo Proprietário
        </a>
    </div>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th width="180">Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php while ($p = mysqli_fetch_assoc($resultado)) { ?>

            <tr>

                <td><?= $p["id"] ?></td>
                <td><?= $p["nome"] ?></td>
                <td><?= $p["telefone"] ?></td>
                <td><?= $p["email"] ?></td>

                <td>

                    <a href="editar.php?id=<?= $p["id"] ?>" class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <a href="excluir.php?id=<?= $p["id"] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja realmente excluir este proprietário?');">
                        Excluir
                    </a>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<?php
require_once "../includes/footer.php";
?>
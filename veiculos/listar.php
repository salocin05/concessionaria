<?php
require_once "../includes/verifica_login.php";
require_once "../config/conexao.php";

$sql = "SELECT
            v.id,
            v.modelo,
            v.marca,
            v.ano,
            v.placa,
            p.nome AS proprietario
        FROM veiculos v
        INNER JOIN proprietarios p
        ON v.proprietario_id = p.id
        ORDER BY v.modelo";

$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Veículos</title>

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

    <div class="d-flex justify-content-between mb-3">

        <h2>Veículos</h2>

        <a href="cadastrar.php" class="btn btn-success">
            Novo Veículo
        </a>

    </div>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Ano</th>
                <th>Placa</th>
                <th>Proprietário</th>
                <th width="200">Ações</th>

            </tr>

        </thead>

        <tbody>

        <?php while ($v = mysqli_fetch_assoc($resultado)) { ?>

            <tr>

                <td><?= $v["id"] ?></td>
                <td><?= $v["modelo"] ?></td>
                <td><?= $v["marca"] ?></td>
                <td><?= $v["ano"] ?></td>
                <td><?= $v["placa"] ?></td>
                <td><?= $v["proprietario"] ?></td>

                <td>

                    <a href="editar.php?id=<?= $v["id"] ?>" class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <a href="excluir.php?id=<?= $v["id"] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja realmente excluir este veículo?');">
                        Excluir
                    </a>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<footer class="bg-dark text-white text-center p-3 mt-5">

    Sistema de Concessionária © 2026

</footer>

</body>

</html>
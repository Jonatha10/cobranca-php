<?php
session_start();

if (isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])) {
    require("../acoes/conexao.php");

    $adm  = $_SESSION["usuario"][1];
    $nome = $_SESSION["usuario"][0];
} else {
    echo "<script>window.location = '../index.html'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sistema de cobrança</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>

    <div class="p-3 mb-2 bg-dark text-white">
        <div class="container ">
            <h2 class="text-center">SISTEMA DE COBRANÇAS</h2>
        </div>


    </div>


    <div class="container p-4">

        <div>
            <!-- MESSAGES -->

            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_unset();
            } ?>


            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">

                <div class="btn-group" role="group" aria-label="First group">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Adicionar nova empresa
                    </button>
                </div>

                <div class="btn-group" role="group" aria-label="Second group">
                    <a href="../acoes/logout.php" class="btn btn-danger">Sair</a>
                </div>




                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nova empresa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card card-body">
                                    <form action="/cobranca/acoes/save_empresa.php" method="POST">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome" class="form-control" id="nome">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <input type="number" name="telefone" class="form-control" id="telefone">
                                        </div>
                                        <div class="form-group">
                                            <label for="data">Data de vencimento</label>
                                            <input type="date" name="data" class="form-control" id="data">
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option>Pago</option>
                                                <option>Aberto</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="observacao">Observação</label>
                                                <textarea name="observacao" class="form-control" id="observacao" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="modal-footer pt-4">
                                                <input type="submit" name="save_empresa" class="btn btn-primary " value="Salvar">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

        </div>

        <table class="table table-striped table-hover table-bordered mt-5">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nome da Empresa</th>
                    <th>Telefone</th>
                    <th>Data de Vencimento</th>
                    <th>Status</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $conn = mysqli_connect("localhost", "root", "", "videoaula");
                $query = "SELECT * FROM empresa";
                $result_empresa = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result_empresa)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['telefone']; ?></td>
                        <td><?php echo $row['data']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['observacao']; ?></td>


                        <td>
                            <a href="../cobranca/acoes/view.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="../cobranca/acoes/edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i>
                            </a>
                            <a href="../cobranca/acoes/delete_empresa.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>

    <?php include('includes/footer.php'); ?>
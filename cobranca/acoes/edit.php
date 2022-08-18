<?php
session_start();

if (isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])) {
    require("../../acoes/conexao.php");

    $adm  = $_SESSION["usuario"][1];
    $nome = $_SESSION["usuario"][0];
} else {
    echo "<script>window.location = '../../index.html'</script>";
}
?>

<?php
include('../../acoes/conexao.php');
$nome = '';
$telefone = '';
$data = '';
$status = '';
$observacao = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM empresa WHERE id=$id";
    $conn = mysqli_connect("localhost", "root", "", "videoaula");
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nome = $row['nome'];
        $telefone = $row['telefone'];
        $data = $row['data'];
        $status = $row['status'];
        $observacao = $row['observacao'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $data = $_POST['data'];
    $status = $_POST['status'];
    $observacao = $_POST['observacao'];

    $query = "UPDATE empresa set nome = '$nome', telefone = '$telefone', data = '$data', status = '$status', observacao ='$observacao' WHERE id=$id";
    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Empresa atualizada com sucesso!';
    $_SESSION['message_type'] = 'warning';
    header('Location: /cobranca/index.php');
}

?>
<?php include('../includes/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="/cobranca/acoes/edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input name="nome" type="text" class="form-control" value="<?php echo $nome; ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input name="telefone" type="text" class="form-control" value="<?php echo $telefone; ?>">
                    </div>
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input name="data" type="text" class="form-control" value="<?php echo $data; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input name="status" type="text" class="form-control" value="<?php echo $status; ?>">
                    </div>
                    <div class="form-group">
                        <label for="observacao">Observação</label>
                        <textarea name="observacao" class="form-control" cols="30" rows="10"><?php echo $observacao; ?></textarea>
                    </div>
                    <div class="modal-footer pt-4">
                        <a href="/cobranca/index.php" class="btn btn-secondary">Voltar</a>
                        <button class="btn btn-success" name="update">
                            ATUALIZAR
                        </button>
                    </div>




                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');
?>
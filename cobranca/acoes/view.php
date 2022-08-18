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
include('../includes/header.php');

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

?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="/cobranca/acoes/view.php?id=<?php echo $_GET['id']; ?>" method="GET">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input name="nome" type="text" class="form-control" value="<?php echo $nome; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input name="telefone" type="text" class="form-control" value="<?php echo $telefone; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input name="data" type="text" class="form-control" value="<?php echo $data; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input name="status" type="text" class="form-control" value="<?php echo $status; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="observacao">Observação</label>
                        <textarea name="observacao" class="form-control" cols="30" rows="10" readonly><?php echo $observacao; ?></textarea>
                    </div>
                    <div class="modal-footer pt-4">
                        <a href="/cobranca/index.php" class="btn btn-secondary">Voltar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');
?>
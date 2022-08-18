<?php

include ('../../acoes/conexao.php');

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM empresa WHERE id = $id";
  $conn= mysqli_connect("localhost","root","","videoaula");
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Empresa deletada com sucesso';
  $_SESSION['message_type'] = 'danger';
  header('Location: /cobranca/index.php');
}

?>

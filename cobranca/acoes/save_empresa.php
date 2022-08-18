<?php

include ('../../acoes/conexao.php');






if (isset($_POST['save_empresa'])) {
  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $data = $_POST['data'];
  $status = $_POST['status'];
  $observacao = $_POST['observacao'];

  $conn= mysqli_connect("localhost","root","","videoaula");
  $query = "INSERT INTO empresa ( nome, telefone, data, status, observacao) VALUES ('$nome', '$telefone', '$data', '$status', '$observacao')";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die('Query failed.');
  }
  $_SESSION['message'] = 'Empresa adicionada com sucesso';
  $_SESSION['message_type'] = 'success';
  header('Location: /cobranca/index.php');
}






?>

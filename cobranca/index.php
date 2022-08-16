

<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

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


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Adicionar nova empresa
    </button>

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
              <form action="save_empresa.php" method="POST">
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
            <a href="view.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
              <i class="fas fa-eye"></i>
            </a>
            <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
              <i class="fas fa-marker"></i>
            </a>
            <a href="delete_empresa.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
              <i class="far fa-trash-alt"></i>
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>


</div>

<?php include('includes/footer.php'); ?>
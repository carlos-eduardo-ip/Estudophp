<?php

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['email'])) {
  include('./php/verificarLogin.php');
}

include('./php/conexao.php');

$sql_code = "SELECT * FROM formulario ORDER BY id ASC";
$result = $mysqli->query($sql_code);

$mysqli->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciador de Usuários</title>
  <script src="./js/closebtn.js"></script>
  <link rel="stylesheet" href="./assets/styleg.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="./painel.php">Página Inicial</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./sobrenos.php">Sobre Nós</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contato</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gerenciador.php">Gerenciador</a>
        </li>
        <?php
        echo "
          <li class='nav-item'><p>Seja Bem-Vindo(a) {$_SESSION['nome']}</p></li>";
        ?>
      </ul>
      <div class="btn-sair">
        <a href="./php/logout.php" class="btn btn-danger">Sair</a>
      </div>
    </div>
  </nav>

  <?php
  if (isset($_SESSION['editsucess'])) {
    echo '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Cadastro atualizado com sucesso!.</strong>
                <button type="button" class="btn-close"  onclick="closeFunction()" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    unset($_SESSION['editsucess']);
  }
  if (isset($_SESSION['delsucess'])) {
    echo '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Usuário deletado com sucesso!</strong>
                <button type="button" class="btn-close"  onclick="closeFunction()" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    unset($_SESSION['delsucess']);
  }

  ?>

  <div class="table-responsive m-5">
    <table class="table table-striped table-dark table-bg">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">NOME</th>
          <th scope="col">TELEFONE</th>
          <th scope="col">IDADE</th>
          <th scope="col">CEP</th>
          <th scope="col">RUA</th>
          <th scope="col">BAIRRO</th>
          <th scope="col">CIDADE</th>
          <th scope="col">DATA DO CADASTRO</th>
          <th scope="col">AÇÕES</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
        while ($users_date = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $users_date['id'] . "</td>";
          echo "<td>" . $users_date['nome'] . "</td>";
          echo "<td>" . $users_date['telefone'] . "</td>";
          echo "<td>" . $users_date['idade'] . "</td>";
          echo "<td>" . $users_date['cep'] . "</td>";
          echo "<td>" . $users_date['rua'] . "</td>";
          echo "<td>" . $users_date['bairro'] . "</td>";
          echo "<td>" . $users_date['cidade'] . "</td>";
          echo "<td>" . $users_date['data_cadastro'] . "</td>";
          echo "<td> 
              <a class='btn btn-sm btn-primary' href='upload.php?id=$users_date[id]'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
              <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
              </svg>
              </a>
              <a class='btn btn-sm btn-danger' href='./php/deledit.php?id=$users_date[id]'>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
              <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
            </svg>
              <a/>
              </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>
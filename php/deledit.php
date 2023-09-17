<?php

if (isset($_POST['update'])) {
  include('conexao.php');

  $id = $_POST['idx'];
  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $idade = $_POST['idade'];
  $cep = $_POST['cep'];
  $rua = $_POST['rua'];
  $bairro = $_POST['bairro'];
  $cidade = $_POST['cidade'];

  $sql_code = "UPDATE formulario SET nome='$nome', telefone='$telefone', idade='$idade', cep='$cep', rua='$rua', bairro='$bairro', cidade='$cidade' WHERE id='$id'";
  $result = $mysqli->query($sql_code);
  $_SESSION['editsucess'] = true;
} elseif (!empty($_GET['id'])) {
  include('conexao.php');
  $id = $_GET['id'];

  $sql_code = "SELECT COUNT(*) AS total FROM formulario WHERE id = '$id'";
  $result = $mysqli->query($sql_code);
  $row = $result->fetch_assoc();

  if ($row['total'] == 1) {
    $sql_code = "DELETE FROM formulario WHERE id = '$id'";
    $resultDelete = $mysqli->query($sql_code);
    $_SESSION['delsucess'] = true;
    die(header("Location: ../gerenciador.php"));
  }
}
die(header('Location: ../gerenciador.php'));

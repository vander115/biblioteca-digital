<?php
require '../../pages/public/page_loading.php';
require '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];

  $query = mysqli_query($conn, "UPDATE tb_pessoa SET statusPessoa = 'inativo' WHERE idPessoa = '$id';");

  if ($query) {
    $_SESSION['toast_success'] = "Aluno deletado com sucesso!";
    header('Location: ../../../index.php?p=alunos');
  } else {
    $_SESSION['toast_error'] = "Erro ao deletar aluno!";
    header('Location: ../../../index.php?p=funcionarios');
  }
} else {
  header('Location: ../../../index.php?p=alunos');
}

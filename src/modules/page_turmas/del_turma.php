<?php
if (!isset($_SESSION)) {
  session_start();
}
require '../../pages/public/page_loading.php';
require '../conection.php';


$id = $_GET['del_turma'];
$query_del_alunos = mysqli_query($conn, "DELETE FROM tb_pessoa WHERE turmaPessoa = '$id';");

if ($query_del_alunos) {
  $query = mysqli_query($conn, "DELETE FROM tb_turma WHERE idTurma = '$id';");
  if ($query) {
    $_SESSION['toast_success'] = "Turma deletada com sucesso!";
    header('Location: ../../../index.php?p=turmas');
  } else {
    $_SESSION['toast_error'] = "Erro ao deletar turma :(";
    header('Location: ../../../index.php?p=turmas');
  }
} else {
  $_SESSION['toast_error'] = "Erro ao deletar alunos da turma :(";
  header('Location: ../../../index.php?p=turmas');
}

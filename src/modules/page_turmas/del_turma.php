<?php
require '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

$id = $_GET['del_turma'];
$query_del_alunos = mysqli_query($conn, "DELETE FROM tb_aluno WHERE turmaAluno = '$id';");

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

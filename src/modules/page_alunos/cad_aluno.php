<?php

require '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

$id = uniqid('aluno_', true) . uniqid();
$nome = mb_strtoupper($_POST['nome']);
$turma = $_POST['turma'];
$tipoIdent = $_POST['tipoIdent'];
$ident = password_hash($_POST['ident'], PASSWORD_DEFAULT);

$query_cad_aluno = mysqli_query($conn, "INSERT INTO tb_pessoa VALUES('$id', '$nome', 'Aluno', '$turma', '$tipoIdent', '$ident', 'ativo');");

if ($query_cad_aluno) {
  $_SESSION['toast_success'] = "Aluno cadrastado com sucesso!";
  header('Location: ../../../index.php?p=alunos');
} else {
  $_SESSION['toast_error'] = "Erro ao cadastrar Aluno! :(";
  header('Location: ../../../index.php?p=alunos');
}

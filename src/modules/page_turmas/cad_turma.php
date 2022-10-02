<?php
require '../conection.php';


if (!isset($_SESSION)) {
  session_start();
}

$anoAtual = date('Y');

$nome = mb_strtoupper($_POST['nome']);
$anoTurma = $_POST['ano'];

if ($anoTurma == 1) {
  $anoInicial = $anoAtual;
  $anoFinal = $anoAtual + 2;
} else if ($anoTurma == 2) {
  $anoInicial = $anoAtual - 1;
  $anoFinal = $anoAtual + 1;
} else if ($anoTurma == 3) {
  $anoInicial = $anoAtual - 2;
  $anoFinal = $anoAtual;
}

$sql_cad_turma = "INSERT INTO tb_turma VALUES(NULL, '$nome', '$anoTurma', '$anoInicial', '$anoFinal');";
$query_cad_turma = mysqli_query($conn, $sql_cad_turma);

if ($query_cad_turma) {
  $_SESSION['toast_success'] = "Turma cadrastada com sucesso!";
  header('Location: ../../../index.php?p=turmas');
} else {
  $_SESSION['toast_error'] = "Erro ao cadrastar turma!";
  header('Location: ../../../index.php?p=turmas');
}
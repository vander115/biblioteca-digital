<?php

require '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

$nome = mb_strtoupper($_POST['nome']);
$tipo = $_POST['tipo'];
$tipoIdent = $_POST['tipoIdent'];
$ident = password_hash($_POST['ident'], PASSWORD_DEFAULT);

$query_cad_aluno = mysqli_query($conn, "INSERT INTO tb_pessoa VALUES(NULL, '$nome', '$tipo', 0, '$tipoIdent', '$ident', 'ativo');");

if ($query_cad_aluno) {
  $_SESSION['toast_success'] = "Funcionário cadrastado com sucesso!";
  header('Location: ../../../index.php?p=funcionarios');
} else {
  $_SESSION['toast_error'] = "Erro ao cadrastar Funcionário! :(";
  header('Location: ../../../index.php?p=funcionarios');
}

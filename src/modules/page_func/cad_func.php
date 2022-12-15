<?php
if (!isset($_SESSION)) {
  session_start();
}

require '../../pages/public/page_loading.php';
require '../conection.php';

$id = uniqid('func_', true) . uniqid();
$nome = trim(mb_strtoupper($_POST['nome']));
$tipo = $_POST['tipo'];
$tipoIdent = $_POST['tipoIdent'];
$ident = trim($_POST['ident']);
$ident_hash = password_hash($ident, PASSWORD_DEFAULT);

$query_cad_aluno = mysqli_query($conn, "INSERT INTO tb_pessoa VALUES('$id', '$nome', '$tipo', 'funcionarios', '$tipoIdent', '$ident_hash', 'ativo');");

echo var_dump($query_cad_aluno);

if ($query_cad_aluno) {
  $_SESSION['toast_success'] = "Funcionário cadrastado com sucesso!";
  header('Location: ../../../index.php?p=funcionarios');
} else {
  $_SESSION['toast_error'] = "Erro ao cadastrar Funcionário! :(";
  header('Location: ../../../index.php?p=funcionarios');
}

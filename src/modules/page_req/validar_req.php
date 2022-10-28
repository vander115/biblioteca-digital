<?php
require '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['user'])) {

  $_SESSION['toast_error'] = "Essa página não pode ser acessada sem login!";

  die('
      <script type="text/javascript">
          window.location = "../../pages/public/login.php";
      </script>
      ');
}

$idPessoa = $_POST['id-pessoa'];
$idLivro = $_POST['id-livro'];
$tipoIdent = $_POST['tipo-ident'];
$ident  = $_POST['ident'];
$prazo = $_POST['prazo'];

$dataAtual = date('Y-m-d');

$dataEntrega = date("Y-m-d", strtotime("+{$prazo} days", strtotime($dataAtual)));


if ($tipoIdent == 1) {

  $query_validar_pessoa = mysqli_query($conn, "SELECT * FROM tb_pessoa WHERE idPessoa = '$idPessoa' LIMIT 1;");
  $dados_validar_pessoa = mysqli_fetch_assoc($query_validar_pessoa);
  $verificar = password_verify($ident, $dados_validar_pessoa['identPessoa']);
} else if ($tipoIdent == 2) {

  $query_validar_pessoa = mysqli_query($conn, "SELECT * FROM tb_adm LIMIT 1;");
  $dados_validar_pessoa = mysqli_fetch_assoc($query_validar_pessoa);
  $verificar = password_verify($ident, $dados_validar_pessoa['passAdm']);
}

if ($verificar) {
  $query_cad_req = mysqli_query($conn, "INSERT INTO tb_req VALUES(0, '$idPessoa', '$idLivro', '$dataAtual', '$dataEntrega', 'em vigor');");
  if ($query_cad_req) {
    $_SESSION['toast_success'] = "Requisição criada com sucesso!";
    header('Location: ../../../index.php?p=requisicoes');
    unset($_SESSION['req']);
  } else {
    $_SESSION['toast_error'] = "Erro ao criar requisição :(";
    header('Location: ../../../index.php?p=requisicoes');
  }
} else {
  $_SESSION['toast_error'] = "A identificação está incorreta!";
  header('Location: ../../../index.php?p=requisicoes');
}
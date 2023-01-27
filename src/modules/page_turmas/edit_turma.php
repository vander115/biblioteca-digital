<?php
if (!isset($_SESSION)) {
  session_start();
}
require '../../pages/public/page_loading.php';
require '../conection.php';


if (!isset($_SESSION['user'])) {

  $_SESSION['toast_error'] = "Essa página não pode ser acessada sem login!";

  die('
      <script type="text/javascript">
          window.location = "../../pages/public/login.php";
      </script>
      ');
}

$anoAtual = date('Y');

$idTurma = $_POST['id'];
$nomeTurma = mb_strtoupper(trim($_POST['nome']));
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

$query_edit_turma = mysqli_query($conn, "UPDATE tb_turma SET nomeTurma = '$nomeTurma', anoTurma = '$anoTurma', anoInicial = '$anoInicial', anoFinal = '$anoFinal' WHERE idTurma = '$idTurma';");

if ($query_edit_turma) {
  $_SESSION['toast_success'] = "Turma editada com sucesso!";
  header('Location: ../../../index.php?p=turmas');
} else {
  $_SESSION['toast_error'] = "Erro ao editar turma :(";
  header('Location: ../../../index.php?p=turmas');
}

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

$id = $_POST['id'];
$nome = mb_strtoupper($_POST['nome']);
$turma = $_POST['turma'];

$query = mysqli_query($conn, "UPDATE tb_pessoa SET nomePessoa = '$nome', turmaPessoa = '$turma' WHERE idPessoa = '$id';");

if ($query) {
  $_SESSION['toast_success'] = "Aluno alterado com sucesso!";
  header("Location: ../../../index.php?p=alunos");
} else {
  $_SESSION['toast_error'] = "Erro ao editar aluno";
  header("Location: ../../../index.php?p=alunos");
}

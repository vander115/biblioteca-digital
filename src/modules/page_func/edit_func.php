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
$tipo = $_POST['tipo'];

$query = mysqli_query($conn, "UPDATE tb_pessoa SET nomePessoa = '$nome', tipoPessoa = '$tipo' WHERE idPessoa = '$id';");

if ($query) {
  $_SESSION['toast_aviso'] = "Funcionário alterado com sucesso!";
  header("Location: ../../../index.php?p=funcionarios");
} else {
  $_SESSION['toast_error'] = "Erro ao alterar funcionário :(";
  header("Location: ../../../index.php?p=funcionarios");
}

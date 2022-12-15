<?php

require_once '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['user'])) {

  $_SESSION['toast_error'] = "Essa página não pode ser acessada sem login!";

  die('
      <script type="text/javascript">
          window.location = "../../../pages/public/login.php";
      </script>
      ');
}
$id = uniqid('genero_', true) . uniqid();
$title = mb_strtoupper($_POST['title']);

$sql = "INSERT INTO tb_genero_livro VALUES ('$id', '$title');";

$query = mysqli_query($conn, $sql);

if ($query) {
  $_SESSION['toast_success'] = "Gênero cadrastado com sucesso!";
  header('Location: ../../../index.php?p=genders');
} else {
  $_SESSION['toast_error'] = "Erro ao cadastrar Gênero! :(";
  header('Location: ../../../index.php?p=livros');
}

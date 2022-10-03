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


if (isset($_POST['mod'])) {
  $mod = "&mod=simple";
} else {
  $mod = '';
}

$id = $_POST['idLivro'];
$title = mb_strtoupper($_POST['title']);
$author = mb_strtoupper($_POST['author']);
$gender = $_POST['gender'];
$tombo = $_POST['tombo'];
$qtd = $_POST['qtd'];
$edit = mb_strtoupper($_POST['edit']);
$status = $_POST['statusLivro'];

if ($qtd == 0 && $status == "disponivel") {
  $status_livro = "emprestado";
} else if ($qtd > 0 && $status == "emprestado") {
  $status_livro = "disponivel";
} else {
  $status_livro = $status;
}

$sql_edit = "UPDATE tb_livros SET tituloLivro = '$title', autorLivro = '$author', generoLivro = '$gender', tomboLivro = '$tombo', qtdLivro = '$qtd', editoraLivro = '$edit', statusLivro = '$status_livro' WHERE idLivro = '$id';";
$query_edit = mysqli_query($conn, $sql_edit);
if ($query_edit) {
  $_SESSION['toast_success'] = "Livro alterado com sucesso!";
  header("Location: ../../../index.php?p=livros$mod");
} else {
  $_SESSION['toast_error'] = "Erro ao alterar livro ";
  header("Location: ../../../index.php?p=livros$mod");
}

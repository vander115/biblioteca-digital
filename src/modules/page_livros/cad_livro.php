<?php
require '../../pages/public/page_loading.php';
require_once '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['user'])) {

  $_SESSION['toast_error'] = "Essa página não pode ser acessada sem login!";

  die('
      <script type="text/javascript">
          window.location = "../login.php";
      </script>
      ');
}
$id = uniqid('livro_', true) . uniqid();
$title = trim(mb_strtoupper($_POST['title']));
$author = trim(mb_strtoupper($_POST['author']));
$gender = $_POST['gender'];
$tombo = trim($_POST['tombo']);
$qtd = $_POST['qtd'];
$edit = mb_strtoupper($_POST['edit']);
$data = date('Y-m-d');

$verificar_livro = mysqli_num_rows(mysqli_query($conn, "SELECT idLivro FROM tb_livros WHERE tomboLivro = '$tombo';"));

if($verificar_livro) {
  $_SESSION['toast_error'] = "Já existe um livro com esse tombo!";
  header('Location: ../../../index.php?p=livros');
} else {

$sql_cad_livro = "INSERT INTO tb_livros VALUES('$id', '$title', '$gender', '$author', '$edit', '$tombo', '$qtd', 'disponivel', '$data');";

$query_cad_livro = mysqli_query($conn, $sql_cad_livro);

}

if ($query_cad_livro) {
  $_SESSION['toast_success'] = "Livro cadrastado com sucesso!";
  header('Location: ../../../index.php?p=livros');
} else {
  $_SESSION['toast_error'] = "Erro ao cadastrar livro! :(";
  header('Location: ../../../index.php?p=livros');
}

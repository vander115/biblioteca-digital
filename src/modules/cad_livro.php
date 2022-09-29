<?php 
require_once './conection.php';

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

$title = mb_strtoupper($_POST['title']);
$author = mb_strtoupper($_POST['author']);
$gender = $_POST['gender'];
$tombo = $_POST['tombo'];
$qtd = $_POST['qtd'];
$edit = mb_strtoupper($_POST['edit']);


$sql_cad_livro = "INSERT INTO tb_livros VALUES(0, '$title', '$gender', '$author', '$edit', '$tombo', '$qtd', 'disponivel');";

$query_cad_livro = mysqli_query($conn, $sql_cad_livro);

if($query_cad_livro) {
  $_SESSION['toast_success'] = "Livro cadrastado com sucesso!";
  header('Location: ../../index.php?p=livros');
} else {
  $_SESSION['toast_error'] = "Erro ao cadrastar livro! :(";
  header('Location: ../../index.php?p=livros');
}
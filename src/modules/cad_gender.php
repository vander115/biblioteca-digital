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

$sql = "INSERT INTO tb_genero_livro VALUES (0, '$title');";

$query = mysqli_query($conn, $sql);

if($query) {
  $_SESSION['toast_success'] = "Gênero cadrastado com sucesso!";
  header('Location: ../../index.php?p=genders');
}
<?php
if (!isset($_SESSION)) {
  session_start();
}

require '../../pages/public/page_loading.php';
require '../conection.php';


if (isset($_GET['id_del'])) {
  $id = $_GET['id_del'];

  $sql_del_livros = "DELETE FROM tb_livros WHERE generoLivro = '$id';";
  $query_del_livros = mysqli_query($conn, $sql_del_livros);


  if ($query_del_livros) {
    $sql_del_gender = "DELETE FROM tb_genero_livro WHERE idGenero ='$id';";
    $query_del_gender = mysqli_query($conn, $sql_del_gender);
    if ($query_del_gender) {
      $_SESSION['toast_success'] = "Gênero deletado com sucesso!";
      header('Location: ../../../index.php?p=genders');
    } else {
      $_SESSION['toast_error'] = "Erro ao deletar gênero!";
      header('Location: ../../../index.php?p=genders');
    }
  } else {
    $_SESSION['toast_error'] = "Erro ao deletar gênero!";
    header('Location: ../../../index.php?p=genders');
  }
} else {
  header('Location: ../../../index.php?p=genders');
}

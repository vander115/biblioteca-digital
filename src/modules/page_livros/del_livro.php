<?php

require '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_GET['id_del'])) {
  $id = $_GET['id_del'];

  $query = mysqli_query($conn, "DELETE FROM tb_livros WHERE idLivro = '$id';");

  if ($query) {
    $_SESSION['toast_success'] = "Livro deletado com sucesso!";
    header('Location: ../../../index.php?p=livros');
  } else {
    $_SESSION['toast_error'] = "Erro ao deletar livro!";
    header('Location: ../../../index.php?p=livros');
  }
} else {
  header('Location: ../../../index.php?p=livros');
}

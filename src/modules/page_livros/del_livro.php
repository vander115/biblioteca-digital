<?php

if (!isset($_SESSION)) {
  session_start();
}
require '../../pages/public/page_loading.php';
require '../conection.php';


if (isset($_GET['id_del'])) {
  $id = $_GET['id_del'];

  $query = mysqli_query($conn, "UPDATE tb_livros SET statusLivro = 'arquivado' WHERE idLivro = '$id';");

  if ($query) {
    $_SESSION['toast_success'] = "Livro arquivado com sucesso!";
    header('Location: ../../../index.php?p=livros');
  } else {
    $_SESSION['toast_error'] = "Erro ao arquivar livro!";
    header('Location: ../../../index.php?p=livros');
  }
} else {
  header('Location: ../../../index.php?p=livros');
}

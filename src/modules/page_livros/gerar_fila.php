<?php
if (!isset($_SESSION)) {
  session_start();
}

require '../../pages/public/page_loading.php';
require '../conection.php';


if (isset($_GET['id_livro_fila'])) {
  $id_l = $_GET['id_livro_fila'];
  $_SESSION['fila']['livro'] = $id_l;
}

if (isset($_GET['id_pessoa_fila'])) {
  $id_p = $_GET['id_pessoa_fila'];
  $_SESSION['fila']['pessoa'] = $id_p;
}

if (!isset($_SESSION['fila']['pessoa'])) {
  $_SESSION['toast_aviso'] = "Escolha um aluno ou funcionario!";
  header('Location: ../../../index.php?p=alunos');
} else if (isset($_SESSION['fila']['pessoa']) and isset($_SESSION['fila']['livro'])) {
  $idLivro = $_SESSION['fila']['livro'];
  $idPessoa = $_SESSION['fila']['pessoa'];

  $query_livro = mysqli_query($conn, "SELECT filaEsperaLivro FROM tb_livros WHERE idLivro ='$idLivro';");

  if ($query_livro) {
    $livro = mysqli_fetch_assoc($query_livro);
    $fila = $livro['filaEsperaLivro'];
    $fila_array = explode(',', $fila);
    $add_array = array_push($fila_array, $idPessoa);
    $new_fila = implode(',', $fila_array);
    $query_fila = mysqli_query($conn, "UPDATE tb_livros SET filaEsperaLivro = '$new_fila' WHERE idLivro = '$idLivro';");
    if ($query_fila) {
      $_SESSION['toast_success'] = "Pessoa adicionada a fila com sucesso!";
      header("Location: ../../../index.php?p=livros&edit_livro=$idLivro");
      unset($_SESSION['fila']);
    } else {
      $_SESSION['toast_error'] = "Erro ao adicionar pessoa na fila.";
      header("Location: ../../../index.php?p=livros&edit_livro=$idLivro");
      unset($_SESSION['fila']);
    }
  } else {
    $_SESSION['toast_error'] = "Erro ao adicionar pessoa na fila.";
    header("Location: ../../../index.php?p=livros&edit_livro=$idLivro");
    unset($_SESSION['fila']);
  }
}

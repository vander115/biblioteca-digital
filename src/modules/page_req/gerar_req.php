<?php

require  '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_GET['id_livro_req'])) {
  $id_livro = $_GET['id_livro_req'];
  $_SESSION['req']['livro'] = $id_livro;
}

if (isset($_GET['id_aluno_req'])) {
  $id_aluno = $_GET['id_aluno_req'];
  $_SESSION['req']['aluno'] = $id_aluno;
}

if (isset($_GET['id_func_req'])) {
  $id_func = $_GET['id_func_req'];
  $_SESSION['req']['func'] = $id_func;
}
if (!isset($_SESSION['id_func_req'])) {

  if (isset($_SESSION['req']['livro']) and !isset($_SESSION['req']['aluno'])) {

    $_SESSION['toast_aviso'] = "ESCOLHA UM ALUNO:";
    header('Location: ../../../index.php?p=alunos');
  } else if (!isset($_SESSION['req']['livro']) and isset($_SESSION['req']['aluno'])) {

    $_SESSION['toast_aviso'] = "ESCOLHA UM LIVRO:";
    header('Location: ../../../index.php?p=livros');
  } else if (isset($_SESSION['req']['livro']) and isset($_SESSION['req']['aluno'])) {

    echo 'Requisição feita com sucesso';
  }
} else if (!isset($_SESSION['req']['livro'])) {

  $_SESSION['toast_aviso'] = "ESCOLHA UM LIVRO:";
  header('Location: ../../../index.php?p=livros');
}

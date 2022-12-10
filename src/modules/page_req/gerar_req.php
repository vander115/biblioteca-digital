<?php

require  '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_GET['id_livro_req'])) {
  if ($_GET['id_livro_req'] === 'n') {
    $_SESSION['toast_aviso'] = "Livro indisponivel no momento!";
    header('Location: ../../../index.php?p=livros');
    return;
  } else {
    $id_livro = $_GET['id_livro_req'];
    $_SESSION['req']['livro'] = $id_livro;
  }
}

if (isset($_GET['id_aluno_req'])) {
  $id_aluno = $_GET['id_aluno_req'];
  $_SESSION['req']['aluno'] = $id_aluno;
}

if (isset($_GET['id_func_req'])) {
  $id_func = $_GET['id_func_req'];
  $_SESSION['req']['func'] = $id_func;
}


if (!isset($_SESSION['req']['livro']) and !isset($_SESSION['req']['aluno']) and !isset($_SESSION['req']['func'])) {
  $_SESSION['toast_aviso'] = "ESCOLHA UM LIVRO:";
  header('Location: ../../../index.php?p=livros');
} else if (!isset($_SESSION['req']['func']) and isset($_SESSION['req']['aluno'])) {
  if (!isset($_SESSION['req']['livro'])) {
    $_SESSION['toast_aviso'] = "ESCOLHA UM LIVRO:";
    header('Location: ../../../index.php?p=livros');
  } else {
    $idLivro = $_SESSION['req']['livro'];
    $idAluno = $_SESSION['req']['aluno'];
    $query_validar_req = mysqli_query($conn, "SELECT * FROM tb_req WHERE idLivro = '$idLivro' AND idPessoa = '$idAluno' AND statusReq != 'concluida';");
    if (mysqli_num_rows($query_validar_req)) {
      $_SESSION['toast_error'] = "Essa requisição já existe!";
      header('Location: ../../../index.php?p=requisicoes');
      unset($_SESSION['req']);
    } else {
      $_SESSION['req']['status'] = "pendente";
      header('Location: ../../../index.php?p=requisicoes');
    }
  }
} else if (isset($_SESSION['req']['func']) and !isset($_SESSION['req']['aluno'])) {
  if (!isset($_SESSION['req']['livro'])) {
    $_SESSION['toast_aviso'] = "ESCOLHA UM LIVRO:";
    header('Location: ../../../index.php?p=livros');
  } else {
    $idLivro = $_SESSION['req']['livro'];
    $idFunc = $_SESSION['req']['func'];
    $query_validar_req = mysqli_query($conn, "SELECT * FROM tb_req WHERE idLivro = '$idLivro' AND idPessoa = '$idFunc' AND statusReq != 'concluida';");
    $query_validar_quantidade = mysqli_query($conn, "SELECT * FROM tb_livros WHERE idLivro = '$idLivro' AND qtdLivro = 0;");
    if (mysqli_num_rows($query_validar_req) and !mysqli_num_rows($query_validar_quantidade)) {
      $_SESSION['toast_error'] = "Essa requisição já existe!";
      header('Location: ../../../index.php?p=requisicoes');
      unset($_SESSION['req']);
    } else if (!mysqli_num_rows($query_validar_req) and mysqli_num_rows($query_validar_quantidade)) {
      $_SESSION['toast_error'] = "O livro escolhido não está disponível";
      header('Location: ../../../index.php?p=requisicoes');
      unset($_SESSION['req']);
    } else if (mysqli_num_rows($query_validar_req) and mysqli_num_rows($query_validar_quantidade)) {
      $_SESSION['toast_error'] = "Essa requisição não pode ser efetuada";
      header('Location: ../../../index.php?p=requisicoes');
      unset($_SESSION['req']);
    } else {
      $_SESSION['req']['status'] = "pendente";
      header('Location: ../../../index.php?p=requisicoes');
    }
  }
} else if (isset($_SESSION['req']['livro']) and !isset($_SESSION['req']['aluno']) and !isset($_SESSION['req']['func'])) {
  $_SESSION['toast_aviso'] = "ESCOLHA UM ALUNO:";
  header('Location: ../../../index.php?p=alunos');
} else if (isset($_SESSION['req']['livro']) and isset($_SESSION['req']['aluno']) and isset($_SESSION['req']['func'])) {
  $_SESSION['toast_aviso'] = "Não foi possível alterar pessoa!";
  header('Location: ../../../index.php?p=requisicoes');
}

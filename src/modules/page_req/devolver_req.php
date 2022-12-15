<?php
require '../../pages/public/page_loading.php';
require '../conection.php';

$idReq = $_GET['r'];

$query_req = mysqli_query($conn, "SELECT * FROM tb_req WHERE idReq = '$idReq';");
if ($query_req) {
  $req = mysqli_fetch_assoc($query_req);
  $idLivroReq = $req['idLivro'];
  $query_livro = mysqli_query($conn, "SELECT qtdLivro FROM tb_livros WHERE idLivro = '$idLivroReq';");
  if ($query_livro) {
    $livro = mysqli_fetch_assoc($query_livro);
    $novaQtd = $livro['qtdLivro'] + $req['qtdReq'];
    $query_trocar_qtd = mysqli_query($conn, "UPDATE tb_livros SET qtdLivro = '$novaQtd' WHERE idLivro = '$idLivroReq';");
    if ($query_trocar_qtd) {
      $query_encerrar_req = mysqli_query($conn, "UPDATE tb_req SET statusReq = 'concluida' WHERE idReq = '$idReq';");
      if ($query_encerrar_req) {
        $_SESSION['toast_success'] = "Requisição encerrada com sucesso!";
        header('Location: ../../../index.php?p=requisicoes');
      }
    } else {
      $_SESSION['toast_error'] = "Erro ao encerrar requisição :(";
      header('Location: ../../../index.php?p=requisicoes');
    }
  } else {
    $_SESSION['toast_error'] = "Erro ao encerrar requisição :(";
    header('Location: ../../../index.php?p=requisicoes');
  }
} else {
  $_SESSION['toast_error'] = "Erro ao encerrar requisição :(";
  header('Location: ../../../index.php?p=requisicoes');
}

<?php
if (!isset($_SESSION)) {
  session_start();
}
require '../conection.php';

$idReq = $_POST['id'];
$prazo = $_POST['prazo'];

$quer_prazo = mysqli_query($conn, "SELECT dataEntregaReq FROM tb_req WHERE idReq = '$idReq';");
if ($quer_prazo) {
  $req = mysqli_fetch_assoc($quer_prazo);
  $dataAtual = $req['dataEntregaReq'];
  $new_prazo = date("Y-m-d", strtotime("+{$prazo} days", strtotime($dataAtual)));
  $query_mudar_prazo = mysqli_query($conn, "UPDATE tb_req SET dataEntregaReq = '$new_prazo' WHERE idReq = '$idReq';");
  if ($query_mudar_prazo) {
    $_SESSION['toast_success'] = "Prazo prorrogado com sucesso!";
    header('Location: ../../../index.php?p=requisicoes');
  } else {
    $_SESSION['toast_error'] = "Erro ao prorrogar prazo :(";
    header('Location: ../../../index.php?p=requisicoes');
  }
} else {
  $_SESSION['toast_error'] = "Erro ao prorrogar prazo :(";
  header('Location: ../../../index.php?p=requisicoes');
}

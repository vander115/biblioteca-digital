<?php

if (!isset($_SESSION)) {
  session_start();
}

require '../conection.php';

$id = $_SESSION['user']['id'];
$username = $_POST['username'];

$query = mysqli_query($conn, "UPDATE tb_adm SET loginAdm = '$username' WHERE idAdm = '$id';");

if ($query) {
  $_SESSION['toast_success'] = "Usuário Alterado com sucesso!";
  header('Location: ../../../index.php?p=dados');
} else {
  $_SESSION['toast_error'] = "Não foi possivel alterar o usuário :(";
  header('Location: ../../../index.php?p=dados');
}

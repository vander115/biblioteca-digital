<?php

require '../../pages/public/page_loading.php';
require '../conection.php';

if (!isset($_SESSION)) {
  session_start();
}

$id = $_POST['id'];
$titulo = mb_strtoupper($_POST['title']);

$sql_edit = "UPDATE tb_genero_livro SET nomeGenero = '$titulo' WHERE idGenero = '$id';";
$query_edit = mysqli_query($conn, $sql_edit);

if ($query_edit) {
  $_SESSION['toast_success'] = "Gênero alterado com sucesso!";
  header('Location: ../../../index.php?p=genders');
} else {
  $_SESSION['toast_success'] = "Erro ao alterar gênero :(";
  header('Location: ../../../index.php?p=genders');
}

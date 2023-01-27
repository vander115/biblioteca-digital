<?php

if (!isset($_SESSION)) {
    session_start();
}

require '../conection.php';

$idAdm = $_SESSION['user']['id'];
$senha = $_POST['pass'];
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$query = mysqli_query($conn, "UPDATE tb_adm SET passAdm = '$senha_hash' WHERE idAdm = '$idAdm'; ");

if ($query) {
    $_SESSION['toast_success'] = "Senha alterada com sucesso!";
    header('Location: ../../../index.php?p=dados');
} else {
    $_SESSION['toast_error'] = "Não foi possivel editar a senha!:(";
    header('Location: ../../../index.php?p=dados');
}

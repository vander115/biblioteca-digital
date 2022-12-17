<?php

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['theme'] == 'default') {
    $_SESSION['theme'] = 'dark';
} else if ($_SESSION['theme'] == 'dark') {
    $_SESSION['theme'] == 'default';
}

$_SESSION['toast_success'] = "Tema alterado com sucesso!";
header('Location: ../../../index.php?p=dados');

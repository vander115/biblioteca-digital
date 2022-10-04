<?php

require '../conection.php';

$nome = $_POST['nome'];
$turma = $_POST['turma'];
$tipoIdent = $_POST['tipoIdent'];
$ident = password_hash($_POST['ident'], PASSWORD_DEFAULT);

$query_cad_aluno = "INSERT INTO tb_alunos ";

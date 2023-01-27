<?php

function mudar_ano_turma()
{
  require 'src/modules/conection.php';

  $query_mudar_turma = mysqli_query($conn, "SELECT * FROM tb_turma ORDER BY anoTurma;");

  $data = date('Y');

  while ($turma = mysqli_fetch_assoc($query_mudar_turma)) {
    $id = $turma['idTurma'];
    if ($turma['anoFinal'] == $data) {
      mysqli_query($conn, "UPDATE tb_turma SET anoTurma = 3, statusTurma = 'egressa' WHERE idTurma = '$id';");
    } else if ($turma['anoFinal'] == ($data + 1)) {
      mysqli_query($conn, "UPDATE tb_turma SET anoTurma = 2, statusTurma = 'egressa' WHERE idTurma = '$id';");
    } else if ($turma['anoFinal'] == ($data + 2)) {
      mysqli_query($conn, "UPDATE tb_turma SET anoTurma = 1, statusTurma = 'egressa' WHERE idTurma = '$id';");
    }
    if ($turma['anoFinal'] <= ($data - 1)) {
      mysqli_query($conn, "UPDATE tb_turma SET statusTurma = 'concluida' WHERE idTurma = '$id';");
    }
  }
}

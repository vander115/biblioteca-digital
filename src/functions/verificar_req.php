<?php

function verificarReq()
{
  require 'src/modules/conection.php';
  $query_req_ver = mysqli_query($conn, "SELECT idReq, dataEntregaReq, statusReq FROM tb_req;");

  if ($query_req_ver) {
    while ($req_ver = mysqli_fetch_assoc($query_req_ver)) {
      $idReq = $req_ver['idReq'];

      $dataEnt = new DateTime($req_ver['dataEntregaReq']);
      $dataNow = new DateTime(date("Y-m-d"));
      $diasRest = $dataEnt->diff($dataNow)->format('%a');

      if ($diasRest <= 0 and $req_ver['statusReq'] == 'ativa') {
        mysqli_query($conn, "UPDATE tb_req SET statusReq ='pendente' WHERE idReq = '$idReq';");
      } else if ($diasRest > 0 and $req_ver['statusReq'] == 'pendente') {
        mysqli_query($conn, "UPDATE tb_req SET statusReq ='ativa' WHERE idReq = '$idReq';");
      }
    }
  }
}

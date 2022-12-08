<?php

$mysqli = new mysqli('localhost', 'root', '', 'bd_biblioteca_digital');

require '../src/modules/conection.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = "SELECT p.nomePessoa, p.tipoPessoa, l.tituloLivro, l.autorLivro, r.dataReq, r.dataEntregaReq, r.statusReq, r.idReq, t.nomeTurma, t.anoTurma, t.idTurma FROM tb_req AS r JOIN tb_pessoa AS p JOIN tb_livros AS l JOIN tb_turma as t ON r.idLivro = l.idLivro AND r.idPessoa = p.idPessoa AND p.turmaPessoa = t.idTurma WHERE statusReq = 'pendente' ORDER BY r.dataEntregaReq;";
$resultado = $conn->query($sql);

if ($resultado) {
  echo 'ok';
} else {
  echo 'error';
}

$excel = new Spreadsheet();
$sheet = $excel->getActiveSheet();
$sheet->setTitle("Biblioteca");

$styles = [
  'font' => [
    'bold' => true,
    'color' => [
      'rgb' => '000000'
    ]
  ]
];

$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Livro');
$sheet->setCellValue('C1', 'Autor');
$sheet->setCellValue('D1', 'Pessoa');
$sheet->setCellValue('E1', 'Turma');
$sheet->setCellValue('F1', 'Data de Requisição');
$sheet->setCellValue('G1', 'Data de Devolução');
$sheet->setCellValue('H1', 'Status');
$sheet->setCellValue('I1', 'Tipo Pessoa');

$sheet->getStyle('A1:G1')->applyFromArray($styles);

$fila = 2;
if ($resultado) {
  while ($rows = $resultado->fetch_assoc()) {
    $sheet->setCellValue('A' . $fila, $rows['idReq']);
    $sheet->setCellValue('B' . $fila, $rows['tituloLivro']);
    $sheet->setCellValue('C' . $fila, $rows['autorLivro']);
    $sheet->setCellValue('D' . $fila, $rows['nomePessoa']);
    $sheet->setCellValue('E' . $fila, $rows['nomeTurma']);
    $sheet->setCellValue('F' . $fila, date("d/m/Y", strtotime($rows['dataReq'])));
    $sheet->setCellValue('G' . $fila, date("d/m/Y", strtotime($rows['dataEntregaReq'])));
    $sheet->setCellValue('H' . $fila, $rows['statusReq']);
    $sheet->setCellValue('I' . $fila, $rows['tipoPessoa']);


    $fila++;

    echo implode($rows) . '<br />';
  }
}

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename="Biblioteca.xlsx"');
// header('Cache-Control: max-age=0');

// $writer = IOFactory::createWriter($excel, 'Xlsx');
// $writer->save('php://output');

$dataAtual = date("d-m-Y");



$writer = new Xlsx($excel);
$writer->save("../relatorios/requisicoes/BD - Livros Pendentes gerado em $dataAtual.xlsx");

if (!isset($_SESSION)) {
  session_start();
}

$_SESSION['toast_success'] = "Relatório gerado com sucesso!";
header('Location: ../index.php?p=requisicoes');

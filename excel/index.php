<?php

$mysqli = new mysqli('localhost', 'root', '', 'bd_biblioteca_digital_novo');

require '../src/modules/conection.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = "SELECT * FROM tb_livros as l JOIN tb_genero_livro as g ON l.generoLivro = g.idGenero ORDER BY tituloLivro;";
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
$sheet->setCellValue('B1', 'Titulo');
$sheet->setCellValue('C1', 'Autor');
$sheet->setCellValue('D1', 'Editora');
$sheet->setCellValue('E1', 'Tombo');
$sheet->setCellValue('F1', 'Gênero');
$sheet->setCellValue('G1', 'Data de Cadrasto');

$sheet->getStyle('A1:G1')->applyFromArray($styles);

$fila = 2;
if ($resultado) {
  while ($rows = $resultado->fetch_assoc()) {
    $sheet->setCellValue('A' . $fila, $rows['idLivro']);
    $sheet->setCellValue('B' . $fila, $rows['tituloLivro']);
    $sheet->setCellValue('C' . $fila, $rows['autorLivro']);
    $sheet->setCellValue('D' . $fila, $rows['editoraLivro']);
    $sheet->setCellValue('E' . $fila, $rows['tomboLivro']);
    $sheet->setCellValue('F' . $fila, $rows['nomeGenero']);
    $sheet->setCellValue('G' . $fila, $rows['dataCadLivro']);

    $fila++;
  }
}

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename="Biblioteca.xlsx"');
// header('Cache-Control: max-age=0');

// $writer = IOFactory::createWriter($excel, 'Xlsx');
// $writer->save('php://output');

$dataAtual = date("d-m-Y");



$writer = new Xlsx($excel);
$writer->save("../../../../Users/escola/Desktop/Relátorios de Livros/Relátorio BD - Livros gerado em $dataAtual.xlsx");

if (!isset($_SESSION)) {
  session_start();
}

$_SESSION['toast_success'] = "Relatório gerado com sucesso!";
header('Location: ../index.php?p=livros');

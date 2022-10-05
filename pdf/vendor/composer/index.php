<?php

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml('<p>Olá Mundo</p>');

$dompdf->render();

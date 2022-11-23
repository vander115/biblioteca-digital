<?php

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();

$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

require __DIR__ . '/pdf.php';

$dompdf->loadHtml(ob_get_clean());

$dompdf->render();

header('Content-type: application/pdf');
echo $dompdf->output();

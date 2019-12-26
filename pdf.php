<?php
include 'vendor/autoload.php';
use Dompdf\Dompdf;
$html = $_POST['hidden'];
// var_dump($html);die;
$dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
$dompdf->loadHtml($html);
 $dompdf->setPaper('A7', 'Landscape');
$dompdf->render();
$dompdf->stream("sample.pdf", array("Attachment"=>0));

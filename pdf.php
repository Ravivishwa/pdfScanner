<?php
include 'vendor/autoload.php';
require_once('tcpdf/tcpdf.php');

//$html = $_POST['hidden'];
//$html = '<div class="print" style="font"><section style="width: 9%;float: left;"><div class="pic" style="width: 100px;height:100px;"><img class="pro-pic" style ="width: 70px;height: 70px;margin-left: 0px;" src="uploads/3/a.01.jpg" /><span class="label other" style=""></span><br><span class="label other" style=""></span><br></div></section><section style=""><table style=""><tbody><tr><td style="">பெயர்</td> <td> :</td></tr><tr><td style="width:40%">தந்தையின் பெயர்</td><td> : </td></tr><tr><td style="width:40%">பிறந்த தேதி</td><td> : </td></tr><tr><td style="width:40%">முகவரி</td><td> : </td></tr><tr><td style="">உறுப்பினர் விவரங்கள்</td></tr></tbody></table></section><div class="page_break" style="page-break-before: always;"></div><div style=""><ul><li>செல்வம் காளிராசி ன்</li><li>ரித்விகா என்</li><li>ரித்விக் என்</li><li>ரித்விக் என்</li></ul></div><div class="qr-pic" style=""><div class="qr-pic" style=""></div><div class="qr-pic" style="">2018</div><img class="pro-pic" style ="width: 70px;height: 70px;" src="images/qr.png" /></div>';


require_once('tcpdf/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->setHeaderFont(false);
$pdf->setFooterFont(false);


$html = '<h2>HTML TABLE:</h2>
<table border="1">
    <tr>
        <td><div><img src="uploads/3/a.01.jpg"></div></td>
        <td bgcolor="" align="center" colspan="2">A1 ex<i>amp</i>le <a href="http://www.tcpdf.org">link</a> column span. One two tree four five six seven eight nine ten.<br />line after br<br /><small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal  bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla<ol><li>first<ol><li>sublist</li><li>sublist</li></ol></li><li>second</li></ol><small color="#FF0000" bgcolor="#FFFF00">small small small small small small small small small small small small small small small small small small small small</small></td>
        <td>4B</td>
    </tr>
</table>';
$pdf->AddPage('L','A7');
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('example_006.pdf', 'I');

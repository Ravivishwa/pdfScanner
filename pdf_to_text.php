<?php
// if you are using composer, just use this
include 'vendor/autoload.php';
use Spatie\PdfToText\Pdf;
use Stichoza\GoogleTranslate\GoogleTranslate;
$text = (new Pdf('C:/Users/VIHAAN/Downloads/poppler-0.68.0_x86/poppler-0.68.0/bin/pdftotext.exe'))
    ->setPdf('a.pdf')
    ->setOptions(['layout', 'r 96'])
    ->addOptions(['f 1'])
    ->text();

   

    $tr = new GoogleTranslate('en');

	$text = $tr->translate($text);
	$name = substr(explode("Name", $text)[1], 0, strpos(explode("Name", $text)[1], "Fa"));
	$cname = trim(substr(explode("Card Number", $text)[1], 0, strpos(explode("Card Number", $text)[1], "Sh")));
	$ctype = substr(explode("Card Type ", $text)[1], 0, strpos(explode("Card Type ", $text)[1], " Cy"));
	$fname = substr(explode("Name ", $text)[2], 0, strpos(explode("Name ", $text)[2], "Da"));
	$dob = substr(explode("Birth ", $text)[1], 0, strpos(explode("Birth ", $text)[1], "Ge"));
	$shop_code = substr(explode("Shop Code ", $text)[1], 0, strpos(explode("Shop Code ", $text)[1], "El"));

	$address = explode("Address Details ", $text);
	$addresss = [
		'addressLine1' => $address[1],
		'addressLine2' => $address[2],
		'addressLine3' => substr($address[3], 0, strpos($address[3], "Po"))
	];
	 // var_dump(explode("Address Line ", $text));die;
	 var_dump($address);die;
?>
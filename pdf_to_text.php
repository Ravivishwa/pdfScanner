<?php
include 'vendor/autoload.php';
include ( 'PdfToText/PdfToText.phpclass' ) ;
use Spatie\PdfToText\Pdf;
use Stichoza\GoogleTranslate\GoogleTranslate;


	function extractData($file){
		$file		=  explode('.',$file)[0];
		$file = __DIR__.'/'.$file;
		$pdf		=  new PdfToText ( "$file.pdf", PdfToText::PDFOPT_DECODE_IMAGE_DATA ) ;
		$image_count 	=  count ( $pdf -> Images ) ;
		if  ( $image_count )
		   {
			for  ( $i = 0 ; $i  <  $image_count ; $i ++ )
			   {
				$img		=  $pdf -> Images [$i] ;
				$imgindex 	=  sprintf ( "%02d", $i + 1 ) ;
				$output_image	=  "$file.$imgindex.jpg" ;
				$textcolor	=  imagecolorallocate ( $img -> ImageResource, 0, 0, 255 ) ;
				$img -> SaveAs ( $output_image ) ;
			    }
		    }
		}

	function extractText($file){
		$db = mysqli_connect('localhost', 'root', '', 'multi_login');
		$userid =$_SESSION['user']['id'];
		$text = (new Pdf('C:/wamp64/www/pdfScanner/poppler-0.68.0/bin/pdftotext.exe'))
		    ->setPdf($file)
		    ->setOptions(['layout', 'r 96'])
		    ->addOptions(['f 1'])
		    ->text();
		var_dump($text);die;
	    $tr = new GoogleTranslate('en');

		$text = $tr->translate($text);
		$name = trim(substr(explode("Name", $text)[1], 0, strpos(explode("Name", $text)[1], "Fa")));
		$cname = trim(substr(explode("(UFC)", $text)[1], 0, strpos(explode("Card Number", $text)[1], "Sh")));

		$ctype = trim(substr(explode("Card Type ", $text)[1], 0, strpos(explode("Card Type ", $text)[1], " Cy")));
		$fname = trim(substr(explode("Name ", $text)[2], 0, strpos(explode("Name ", $text)[2], "Da")));
		$dob = trim(substr(explode("Birth ", $text)[1], 0, strpos(explode("Birth ", $text)[1], "Ge")));
		$shop_code = trim(substr(explode("Shop Code ", $text)[1], 0, strpos(explode("Shop Code ", $text)[1], "El")));
		$shop_code = trim(substr(explode("Shop Code ", $text)[1], 0, strpos(explode("Shop Code ", $text)[1], "El")));

		$add = explode("Address Line", $text);
		$add1 = explode("/", $add[1]);
		$add2 = explode(" 2", $add[2]);
		$add3 = explode(" 3", $add[3]);
		$taluka = explode("Taluk", $add1[1])[1];
		$district = explode("District", $add2[1])[1];
		$post = explode("Code", $add3[1])[1];

		$post = trim(substr($post, 0, strpos($post, "Vi")));
		$a1 = trim(substr($add1[1], 0, strpos($add1[1], "Ta")));
		$a2 = trim(substr($add2[1], 0, strpos($add2[1], "Di")));
		$a3 = trim(substr($add3[1], 0, strpos($add3[1], "Po")));

		$address = $a1.','.$a2.' '.$a3.', Taluka-'.$taluka.', District-'.$district.', Postal Code-'.$post;

		// var_dump(explode("# Name Gender Birth Date Correlation", $text));die;
		$query = "INSERT INTO user_data (user_id,name, card_name, card_type, father_name,dob,shop_code,address,year ) 
						  VALUES('$userid','$name', '$cname', '$ctype', '$fname','$dob','$shop_code','$address','')";


//		echo $query;
		mysqli_query	($db, $query);

		$userDetail = [
			'name' => $name,
			'card_name' => $cname,
			'card_type' => $ctype,
			'father_name' => $fname,
			'dob' => $dob,
			'shop_code' => $shop_code,
			'address' => $address
		];
		return $userDetail;
	}
?>

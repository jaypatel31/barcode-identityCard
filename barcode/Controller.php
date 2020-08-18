<?php
session_start();
if(isset($_POST['submit'])){
	$Fname = htmlentities($_POST['fname']);
	$Lname = htmlentities($_POST['lname']);
	$Roll = htmlentities($_POST['enroll']);
	
	if(is_numeric($_POST['phone']) && (strlen($_POST['phone'])==10)){
		$Phone = $_POST['phone'];
	}
	else{
		$_SESSION['error'] = "Please Input Valid Mobile Number";
		header('Location: index.php');
		return;
	}
	$Email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
	if(!$Email){
		$_SESSION['error'] = "Please Input Valid Email Address";
		header('Location: index.php');
		return;
	}
	$branch = $_POST['branch'];
	$Sem = $_POST['sem'];
	$file = $_FILES['filename']['name'];
	if($_FILES['filename']['type'] !== 'image/jpeg' ){
		$_SESSION['error'] = 'Inavlid Format(Supported Only JPEG)';
		header('Location: index.php');
		return;
	}
	else{
		move_uploaded_file($_FILES['filename']['tmp_name'],'upload/'.$file);
		
	}
}
?>
<!DOCTYPE html>
<html>
<head><title>Encode Workshop Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
            body {font-family:Arial, Helvetica, sans-serif;}
            table {border: 1px solid black;}
            th {border: 1px solid black;padding:4px;background-barcode:cornsilk;}
            td {border: 1px solid black;padding:4px;}
            h3 {color:darkblue;}
            h4 {color:darkgreen;}
            h4 span  {color:firebrick;}
			#logo{
				width:150px;
			}
			#heading{
				display:inline-block;
			}
        </style>
</head>
<body class="bg-light">
<div class="jumbotron text-center text-white bg-primary">
<img id="logo" class="pb-1" src="logo.jpg" alt="LOGO">
<h2 id="heading">IDENTITY CARD</h2>
</div>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	ob_start();
    require('../fpdf/fpdf.php');
    $pdf = new FPDF('L','mm',array(250,150));
    $pdf->AddPage();
	$pdf->SetFont('Courier','B',40);
	$pdf->Cell(70);
	$pdf->SetTextColor(0,0,255);
    $pdf->Cell(100,40,'WORKSHOP IDENTITY CARD',0,2,"C");
	$pdf->Ln(3);
	$pdf->SetFontSize(14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(150,13,'Name 	   : '.$Fname." ".$Lname,0,2,"L");
	$pdf->Cell(150,13,'Roll No  : '.$Roll,0,2,"L");
	$pdf->Cell(150,13,'Branch   : '.$branch,0,2,"L");
	$pdf->Cell(150,13,'Semester : '.$Sem,0,2,"L");
	$pdf->Cell(150,13,'EMAIL    : '.$Email,0,2,"L");
	$pdf->Ln(15);
	
	$pdf->SetDrawColor(5,150,0);
	$pdf->SetFillColor(100,150,0);
	$pdf->image('upload/'.$file,205,55,40);
	$pdf->image('logo.png',85,3,70,20);
    $pdf->Output('F','save/'.$Roll.'.pdf');
    ob_end_flush();
}
?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
  require ('../vendor5/autoload.php');
$barcode = new \Com\Tecnick\Barcode\Barcode();
$examples = '<h3>Linear</h3>'."\n";
$type='C128C';
$code = '31082001';
 $bobj = $barcode->getBarcodeObj($type, $code, -3, -30, 'black', array(0, 0, 0, 0));
 $examples .= '<h4>[<span>'.$type.'</span>] '.$code.'</h4><p style="font-family:monospace;">'.$bobj->getHtmlDiv().'</p>'."\n";
$bobj = $barcode->getBarcodeObj('QRCODE,H', 'http://b52deb8b25f5.ngrok.io/PHPEX/Encode/save/'.$Roll.'.pdf', -4, -4, 'black', array(-2, -2, -2, -2))->setBackgroundColor('#f0f0f0');

echo "

        <h2>Output Formats</h2>
		<h3>Scan Code To Download Your IDENTITY Card</h3>
       <h3>Your QRCODE</h3>
        <p><img alt=\"Embedded Image\" src=\"data:image/png;base64,".base64_encode($bobj->getPngData())."\" /></p>
    </body>
</html>
";  
	}

?>
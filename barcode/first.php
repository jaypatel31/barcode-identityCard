<!DOCTYPE html>
<html>
<head><title>QR CODE</title></head>
<?php
$err="";
if($_SERVER['REQUEST_METHOD']=='POST'){
	$Fname = $_POST['fname'];
	$Lname = $_POST['lname'];
	$Dob = $_POST['dob'];
	$Email = $_POST['email'];
	$file = $_FILES['filename']['name'];
	echo $_FILES['filename']['type'];
	if($_FILES['filename']['type'] !== 'image/jpeg' ){
		$err = 'Inavlid Format';
	}
	move_uploaded_file($_FILES['filename']['tmp_name'],'upload/'.$file);
}
?>
<body>

<h2>HTML Forms</h2>

<form method="post" enctype="multipart/form-data">
  <label for="fname">First name : </label><br>
  <input type="text" id="fname" name="fname" required placeholder="John"><br><br>
  <label for="lname">Last name : </label><br>
  <input type="text" id="lname" name="lname" required placeholder="Doe"><br><br>
   <label for="lname">Email : </label><br>
  <input type="email" id="lname" name="email" required placeholder="abc@gmail.com"><br><br>
  <label for="dob">DOB : </label><br>
  <input type="date" id="dob" name="dob" required placeholder="dd-mm-yyyy"><br><br>
  <label for="img">Image : </label><br>
  <input type="file" id="img" name="filename" required>
  <span><?php echo $err?></span><br><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	if($err ==""){
	ob_start();
    require('../fpdf/fpdf.php');
    $pdf = new FPDF('L','mm',array(250,150));
    $pdf->AddPage();
	$pdf->SetFont('Courier','B',40);
	$pdf->Cell(70);
	$pdf->SetTextColor(0,0,255);
    $pdf->Cell(100,40,'IDENTITY CARD',0,2,"C");
	$pdf->Ln(5);
	$pdf->SetFontSize(24);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(150,13,'Name 	: '.$Fname." ".$Lname,0,2,"L");
	$pdf->Cell(150,13,'DOB 		: '.$Dob,0,2,"L");
	$pdf->Cell(150,13,'EMAIL : '.$Email,0,2,"L");
	$pdf->Ln(15);
	
	$pdf->SetDrawColor(5,150,0);
	$pdf->SetFillColor(100,150,0);
	$pdf->image('upload/'.$file,205,45,40);
    $pdf->Output('F','save/'.$Fname.'('.$Dob.').pdf');
    ob_end_flush();
}
}
?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	if($err==""){
  require ('../vendor5/autoload.php');
$barcode = new \Com\Tecnick\Barcode\Barcode();
$examples = '<h3>Linear</h3>'."\n";
$type='C128C';
$code = '31082001';
 $bobj = $barcode->getBarcodeObj($type, $code, -3, -30, 'black', array(0, 0, 0, 0));
 $examples .= '<h4>[<span>'.$type.'</span>] '.$code.'</h4><p style="font-family:monospace;">'.$bobj->getHtmlDiv().'</p>'."\n";
$bobj = $barcode->getBarcodeObj('QRCODE,H', 'http://645b0a8bc349.ngrok.io/PHPEX/barcode/save/'.$Fname.'('.$Dob.').pdf', -4, -4, 'black', array(-2, -2, -2, -2))->setBackgroundColor('#f0f0f0');

echo "
<!DOCTYPE html>
<html>
    <head>
        <title>Usage example of tc-lib-barcode library</title>
        <meta charset=\"utf-8\">
        <style>
            body {font-family:Arial, Helvetica, sans-serif;margin:30px;}
            table {border: 1px solid black;}
            th {border: 1px solid black;padding:4px;background-barcode:cornsilk;}
            td {border: 1px solid black;padding:4px;}
            h3 {color:darkblue;}
            h4 {color:darkgreen;}
            h4 span  {color:firebrick;}
        </style>
    </head>
    <body>
        <h2>Output Formats</h2>
		<h3>Scan Code To Download Your IDENTITY Card</h3>
       <h3>Your QRCODE</h3>
        <p><img alt=\"Embedded Image\" src=\"data:image/png;base64,".base64_encode($bobj->getPngData())."\" /></p>
    </body>
</html>
";  
	}
}
?>
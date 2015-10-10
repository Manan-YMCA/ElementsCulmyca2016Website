<?php
require('php/fpdf/pdf_js.php');

class PDF_AutoPrint extends PDF_JavaScript
{
	function AutoPrint($dialog=false)
	{
		//Open the print dialog or start printing immediately on the standard printer
		$param=($dialog ? 'true' : 'false');
		$script="print($param);";
		$this->IncludeJS($script);
	}
}
	
$name = $_GET['name'];
$college = $_GET['college'];

$pdf=new PDF_AutoPrint('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->AddFont('Gill Sans','','gillsans_italic.php');
$pdf->SetFont('Gill Sans','',26);
$pdf->SetXY(102,-85);
$pdf->Cell(168,0, stripslashes($name),0,1,'C');
$pdf->SetXY(102,-53);
$pdf->Cell(168,0, stripslashes($college),0,1,'C');
$pdf->AutoPrint(false);
$pdf->Output();
?>
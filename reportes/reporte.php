<?php

require 'cn.php';
require 'fpdf/fpdf.php';

$pdf = new PDF("P", "mm", "letter");
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",12);
    $pdf->Cell(10,10,"Hola",1,0,"C");
    $pdf->Output();

?>

<?php

require ('fpdf/fpdf.php');

//Conexión
require('../inc/config.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

// OBTENEMOS EL ID DEL USUARIO
$id = $_SESSION['id_usuario'];

$query = "select f.ID_FACTURA as IdFactura,P.TITULO,B.PRECIO,sum(f.SUBTOTAL) as Subtotal,SUM(F.TOTAL) as Total , F.FECHA from FACTURA F 
inner join detalle d on d.ID_FACTURA = F.ID_FACTURA 
inner join CARTELERA c on c.ID_CARTELERA = d.ID_CARTELERA 
inner join pelicula p on p.ID_PELICULA = c.ID_PELICULA
inner join BOLETO b on b.ID_BOLETO = d.ID_BOLETO
group by f.ID_FACTURA";
$statement = $conexion->prepare($query);
$statement->execute();
$venta = $statement->fetchAll(PDO::FETCH_ASSOC);

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    //Logo
    $this->Image('../assets/img/logos/logo-reporte.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Courier','B',12);
    // Movernos a la derecha
    $this->Cell(65);
    // Título
    $this->Cell(60,30,utf8_decode('REPORTE DE VENTAS'),0,0,'C');
    // Salto de línea
    $this->Ln(30);
    // Encabezados
    $this->SetFillColor(233,236,240);
    $this->Cell(1);
    $this->Cell(27,8,utf8_decode('Nº Factura'),0,0,'C',1);
    $this->Cell(1);
    $this->Cell(40,8,utf8_decode('Titulo'),0,0,'C',1);
    $this->Cell(1);
    $this->Cell(30,8,utf8_decode('Precio'),0,0,'C',1);
    $this->Cell(1);
    $this->Cell(30,8,utf8_decode('Subtotal'),0,0,'C',1);
    $this->Cell(1);
    $this->Cell(30,8,utf8_decode('Total'),0,0,'C',1);
    $this->Cell(1);
    $this->Cell(35,8,utf8_decode('Fecha'),0,1,'C',1);
    $this->Ln(3);
}


// Pie de página
function Footer()
{
    // Color
    $this->SetFillColor(31, 73, 99);
    $this->Rect(0, 280, 220, 50, 'F');
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',11);
    // Número de página
    $this->SetX(120);
    $this->SetTextColor(255,255,255);
    $this->Cell(0,10,utf8_decode('Dónde la ficción se convierte en realidad ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','I',10);
$pdf->SetMargins(10,30,20,20);

foreach($venta as $ventas){
    $pdf->Cell(-10);
    $pdf->Cell(38,8,utf8_decode($ventas['f.ID_FACTURA as IdFactura']),0,0,'C',0);
    $pdf->Cell(1);
    $pdf->Cell(40,8,utf8_decode($ventas['P.TITULO']),0,0,'C',0);
    $pdf->Cell(-5);
    $pdf->Cell(38,8,utf8_decode($ventas['B.PRECIO']),0,0,'C',0);
    $pdf->Cell(-10);
    $pdf->Cell(38,8,utf8_decode($ventas['sum(f.SUBTOTAL) as Subtotal']),0,0,'C',0);
    $pdf->Cell(-5);
    $pdf->Cell(38,8,($ventas['SUM(F.TOTAL) as Total']),0,0,'C',0);
    $pdf->Cell(1);
    $pdf->Cell(30,8,($ventas['F.FECHA from FACTURA F']),0,1,'C',0);
}

$pdf->Output();


?>
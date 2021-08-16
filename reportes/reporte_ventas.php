<?php

require ('fpdf/fpdf.php');

//Conexión
require('../inc/config.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

// OBTENEMOS EL ID DEL USUARIO
$id = $_SESSION['id_usuario'];

//OBTENER EL ID DE LA ULTIMA COMPRA DEL USUARIO
$query = "SELECT ID_FACTURA FROM FACTURA
WHERE id_usuario = '$id'
ORDER BY ID_FACTURA DESC
LIMIT 1";
$statement = $conexion->prepare($query);
$statement->execute();
$data = $statement->fetch(PDO::FETCH_ASSOC);
$idFactura = $data['ID_FACTURA'];

// OBTENEMOS EL REPORTE DE LAS VENTAS
$query = "SELECT F.ID_FACTURA AS IdFactura, P.TITULO, B.PRECIO, SUM(F.SUBTOTAL) AS Subtotal, SUM(F.TOTAL) AS Total , F.FECHA FROM FACTURA F 
INNER JOIN DETALLE D ON D.ID_FACTURA = F.ID_FACTURA 
inner join CARTELERA C on C.ID_CARTELERA = D.ID_CARTELERA 
inner join PELICULA P on P.ID_PELICULA = C.ID_PELICULA
inner join BOLETO B on B.ID_BOLETO = D.ID_BOLETO
group by F.ID_FACTURA";
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
    $pdf->Cell(38,8,utf8_decode($ventas['IdFactura']),0,0,'C',0);
    $pdf->Cell(1);
    $pdf->Cell(40,8,utf8_decode($ventas['TITULO']),0,0,'C',0);
    $pdf->Cell(-5);
    $pdf->Cell(38,8,'L '.number_format($ventas['PRECIO'],2),0,0,'C',0);
    $pdf->Cell(-5);
    $pdf->Cell(38,8,'L '.number_format($ventas['Subtotal'],2),0,0,'C',0);
    $pdf->Cell(-9);
    $pdf->Cell(38,8,'L '.number_format($ventas['Total'],2),0,0,'C',0);;
    $pdf->Cell(1);
    $pdf->Cell(30,8,($ventas['FECHA']),0,1,'C',0);
}

$pdf->Output();


?>
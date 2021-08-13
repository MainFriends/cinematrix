<?php
require('fpdf/fpdf.php');

//Conexión
require('../inc/config.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//Query
$query = "SELECT * FROM PELICULA, GENERO, CLASIFICACION, ESTADO
WHERE GENERO.ID_GENERO = PELICULA.ID_GENERO
AND CLASIFICACION.ID_CLASIFICACION = PELICULA.ID_CLASIFICACION
AND ESTADO.ID_ESTADO = PELICULA.ID_ESTADO";
$stm = $conexion->prepare($query);
$stm->execute();
$data = $stm->fetchAll(PDO::FETCH_ASSOC);

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    //Logo
    $this->Image('../assets/img/logos/logo-reporte.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','I',12);
    // Movernos a la derecha
    $this->Cell(65);
    // Título
    $this->Cell(60,30,utf8_decode('REPORTE DE PELICULAS'),0,0,'C');
    // Salto de línea
    $this->Ln(30);
    // Encabezados
    $this->SetFillColor(151,148,159);
    $this->Cell(38,8,utf8_decode('Películas'),0,0,'C',1);
    $this->Cell(38,8,utf8_decode('Estado'),0,0,'C',1);
    $this->Cell(38,8,utf8_decode('Género'),0,0,'C',1);
    $this->Cell(38,8,utf8_decode('Clasificación'),0,0,'C',1);
    $this->Cell(38,8,utf8_decode('Año'),0,1,'C',1);
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

foreach($data as $peli){
    $pdf->Cell(38,8,$peli['TITULO'],0,0,'C',0);
    $pdf->Cell(38,8,utf8_decode($peli['DESCRIPCION']),0,0,'C',0);
    $pdf->Cell(38,8,utf8_decode($peli['GENERO']),0,0,'C',0);
    $pdf->Cell(38,8,utf8_decode($peli['CLASIFICACION']),0,0,'C',0);
    $pdf->Cell(38,8,($peli['AÑO']),0,1,'C',0);
}

$pdf->Output();
?>
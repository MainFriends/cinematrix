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
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(65);
    // Título
    $this->Cell(60,30,utf8_decode('Reporte de Películas'),0,0,'C');
    // Salto de línea
    $this->Ln(30);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Reporte').$this->PageNo().'/{nb}',0,0,'C');
}

}

$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);

foreach($data as $peli){
    $pdf->Cell(38,13,$peli['TITULO'],1,0,'C',0);
    $pdf->Cell(38,13,$peli['AÑO'],1,0,'C',0);
    $pdf->Cell(38,13,utf8_decode($peli['GENERO']),1,0,'C',0);
    $pdf->Cell(38,13,utf8_decode($peli['CLASIFICACION']),1,0,'C',0);
    $pdf->Cell(38,13,utf8_decode($peli['DESCRIPCION']),1,1,'C',0);
}

$pdf->Output();
?>
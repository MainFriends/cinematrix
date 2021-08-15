<?php
require('fpdf/fpdf.php');

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

//MOSTRAR DETALLES DEL BOLETO
$query = "SELECT TITULO, IDIOMA.NOMBRE IDIOMA, FORMATO, CLASIFICACION, FECHA, HORA_INICIO, BOLETO.NOMBRE NOMBRE_BOLETO, PRECIO, BUTACA
FROM PELICULA, IDIOMA, FORMATO, DETALLE, CLASIFICACION, CARTELERA, BOLETO
WHERE PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
AND DETALLE.ID_CARTELERA = CARTELERA.ID_CARTELERA
AND IDIOMA.ID_IDIOMA = CARTELERA.ID_IDIOMA
AND CLASIFICACION.ID_CLASIFICACION = PELICULA.ID_CLASIFICACION
AND FORMATO.ID_FORMATO = CARTELERA.ID_FORMATO
AND DETALLE.ID_BOLETO = BOLETO.ID_BOLETO
AND ID_FACTURA = $idFactura";
$statement = $conexion->prepare($query);
$statement->execute();
$ticket = $statement->fetchAll(PDO::FETCH_ASSOC);

//MOSTRAR FECHA
$query = "SELECT NOW() FECHA";
$statement = $conexion->prepare($query);
$statement->execute();
$fecha = $statement->fetch(PDO::FETCH_ASSOC);
$date = $fecha['FECHA'];

//MOSTRAR DETALLE BOLETO 1
$query = "SELECT BOLETO.NOMBRE NOMBRE_BOLETO, COUNT(BOLETO.ID_BOLETO) CANTIDAD, PRECIO, COUNT(BOLETO.ID_BOLETO)*PRECIO TOTAL
FROM DETALLE, BOLETO
WHERE ID_FACTURA = '$idFactura'
AND DETALLE.ID_BOLETO = BOLETO.ID_BOLETO
AND DETALLE.ID_BOLETO = 1";
$statement = $conexion->prepare($query);
$statement->execute();
$boleto1 = $statement->fetch(PDO::FETCH_ASSOC);

//MOSTRAR DETALLE BOLETO 2
$query = "SELECT BOLETO.NOMBRE NOMBRE_BOLETO, ROUND(COUNT(BOLETO.ID_BOLETO)/2,0) CANTIDAD, PRECIO, ROUND(COUNT(BOLETO.ID_BOLETO)/2,0)*PRECIO TOTAL
FROM DETALLE, BOLETO
WHERE ID_FACTURA = '$idFactura'
AND DETALLE.ID_BOLETO = BOLETO.ID_BOLETO
AND DETALLE.ID_BOLETO = 2;";
$statement = $conexion->prepare($query);
$statement->execute();
$boleto2 = $statement->fetch(PDO::FETCH_ASSOC);

class PDF extends FPDF{

function Header()
{

}
}


global $title;
/*$pdf->SetFont('Courier','B',12);
$pdf->Cell(65);
$pdf->Cell(30,10,$title = 'MULTIPLZA CINEMATRIX',0,0,'C');*/

$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Courier','',10);

$title = '  MULTIPLAZA CINEMATRIX';

foreach($ticket as $boletos){
    $pdf->SetFont('Courier','B',12);
    //Titulo
    $pdf->Cell(190,9,$title = utf8_decode('MULTIPLAZA CINEMATRIX'),0,0,'C');
    $pdf->SetFont('Courier','',11);
    $pdf->Cell(-190,18,($boletos['TITULO']),0,0,'C',0);
    $pdf->Cell(2);
    $pdf->Cell(180,28,($boletos['IDIOMA']),0,0,'C',0);
    $pdf->Cell(2);
    $pdf->Cell(-161,28,($boletos['FORMATO']),0,0,'C',0);
    $pdf->Ln(15);
    $pdf->SetFont('Courier','',12);
    $pdf->Ln(2);
    $pdf->Cell(160,9,$title = utf8_decode('CENSURA: '),0,0,'C');
    $pdf->Ln(1);
    $pdf->Cell(190,7,($boletos['CLASIFICACION']),0,0,'C',0);
    $pdf->Ln(5);
    $pdf->SetFont('Courier','',10);
    $pdf->Cell(68);
    $pdf->Cell(80,7,utf8_decode('Fecha: '.$date),0,0,'L');
    $pdf->SetFont('Courier','B',10);
    $pdf->Cell(-50);
    $pdf->Cell(20,18,utf8_decode('Asiento: '),0,0,'L');
    $pdf->Ln(5);
    $pdf->SetFont('Courier','B',12);
    $pdf->Cell(25);
    $pdf->Cell(190,8,($boletos['BUTACA']),0,0,'C',0);
    $pdf->Cell(-147);
    $pdf->SetFont('Courier','',11);
    $pdf->Cell(20,18,utf8_decode('ADMIT '),0,0,'L');
    $pdf->Cell(2,18,($boletos['BUTACA']),0,0,'C',0);
    $pdf->Ln(10);

        // BOLETO 1
        if($boleto1['CANTIDAD']>0){
            $pdf->Cell(70,8,$boleto1['NOMBRE_BOLETO'],0,0,'L',0);
        }
    
        //BOLETO 2
        if($boleto2['CANTIDAD']>0){
            $pdf->Cell(70,8,$boleto2['NOMBRE_BOLETO'],0,0,'L',0);
        }
        $pdf->Ln(10);
    
}
$pdf->Output();

?>
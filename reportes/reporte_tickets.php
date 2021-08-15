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

class PDF extends FPDF{


function Header()
{

}
}



$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Courier','',10);

foreach($ticket as $boletos){
    $pdf->SetFont('Courier','B',12);
    $pdf->SetMargins(5,5,5,5);
    $pdf->Cell(65);
    //Titulo
    $pdf->Cell(100,8,utf8_decode('MULTIPLAZA CINEMATRIX'),0,0,'C');
    $pdf->Ln(3);
}

$pdf->Output();

?>
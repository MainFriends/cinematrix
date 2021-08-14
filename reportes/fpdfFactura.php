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

    //MOSTRAR DETALLE BOLETO 1
    $query = "SELECT BOLETO.NOMBRE NOMBRE_BOLETO, COUNT(BOLETO.ID_BOLETO) CANTIDAD, PRECIO, COUNT(BOLETO.ID_BOLETO)*PRECIO TOTAL
    FROM DETALLE, BOLETO
    WHERE ID_FACTURA = '$idFactura'
    AND DETALLE.ID_BOLETO = BOLETO.ID_BOLETO
    AND DETALLE.ID_BOLETO = 1;";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $boleto1 = $statement->fetch(PDO::FETCH_ASSOC);

    //MOSTRA COMBOS QUE COMPRO EL USUARIO
    $query = "SELECT COMBO.NOMBRE NOMBRE_COMBO, COUNT(DETALLE.ID_COMBO) CANTIDAD, COMBO.PRECIO, COUNT(DETALLE.ID_COMBO)*PRECIO TOTAL
    FROM DETALLE, COMBO
    WHERE ID_FACTURA = '$idFactura'
    AND DETALLE.ID_COMBO = COMBO.ID_COMBO
    GROUP BY DETALLE.ID_COMBO";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $combos = $statement->fetchAll(PDO::FETCH_ASSOC);
    $resultado = $statement->rowCount();

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    //Logo
    $this->Image('../assets/img/logos/logo-reporte.jpg',85,8,33);
    // Arial bold 15
    $this->SetFont('Courier','B',12);
    // Movernos a la derecha
    $this->Cell(62);
    //Titulo
    $this->Cell(60,50,utf8_decode('CINEMATRIX'),0,0,'C');
    $this->Ln(3);
    // Salto de línea
    $this->Ln(30);
    // Encabezados
    $this->SetFillColor(255,255,255);
    $this->Cell(37,8,utf8_decode('Uds'),0,0,'C',1);
    // Movernos a la derecha
    $this->Cell(-15);
    $this->Cell(40,8,utf8_decode('Descripción'),0,0,'C',1);
    $this->Cell(110,8,utf8_decode('Precio'),0,0,'C',1);
    $this->Cell(-35,8,utf8_decode('Total'),0,1,'C',1);
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

    foreach($combos as $combo){
     $pdf->Cell(38,8,$combo['CANTIDAD'],0,0,'C',0);
     $pdf->Cell(-10);
     $pdf->Cell(70,8,$combo['NOMBRE_COMBO'],0,0,'L',0);
     $pdf->Cell(38,8,$combo['PRECIO'],0,0,'C',0);
     $pdf->Cell(38,8,$combo['TOTAL'],0,1,'C',0);
    }
    $pdf->Output();
?>
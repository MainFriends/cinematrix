<?php
require('fpdf/fpdf.php');

//Conexión
require('../inc/config.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

// OBTENEMOS EL ID DEL USUARIO
    $id = $_SESSION['id_usuario'];

    //PAGO POR SERVICIOS
    $pagoServicios = 25;

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

    //MOSTRAR SUBTOTAL Y TOTAL A PAGAR
    $query = "SELECT SUBTOTAL, DESCUENTO, TOTAL FROM FACTURA
    WHERE ID_FACTURA = '$idFactura'";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $total = $statement->fetch(PDO::FETCH_ASSOC);

    //MOSTRAR FECHA
    $query = "SELECT NOW() FECHA";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $fecha = $statement->fetch(PDO::FETCH_ASSOC);
    $date = $fecha['FECHA'];

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
    $this->Ln(12);
    //Nombre
    $this->Cell(14);
    $this->SetFont('Courier','',12);
    $this->Cell(60,55,utf8_decode('Nombre: '),0,0,'L');
    $this->Cell(-38);
    $this->Cell(60,55,$_SESSION['usuario'],0,0,'L');
    $this->Cell(-43);
    $this->Cell(60,55,$_SESSION['apellido'],0,0,'L');
    $this->Ln(3);
    $this->Cell(14);
    $this->Cell(60,61,utf8_decode('Correo: '),0,0,'L');
    $this->Cell(-38);
    $this->Cell(60,61,$_SESSION['correo'],0,0,'L');
    $this->Ln(3);
    // Salto de línea
    $this->Ln(30);
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
$pdf->SetFont('Courier','',10);
$pdf->SetMargins(10,30,20,20);
    
        $pdf->Cell(14);
        $pdf->SetFont('Courier','',12);
        $pdf->Cell(60,-30,utf8_decode('Nº Factura: '.$idFactura),0,0,'L');
        $pdf->Ln(10);

        $pdf->SetFont('Courier','',12);
        $pdf->Cell(14);
        $pdf->Cell(60,-12,utf8_decode('Fecha: '.$date),0,0,'L');
        $pdf->Ln(3);


        $pdf->SetFont('Courier','B',12); 
        // Encabezados
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(37,8,utf8_decode('Uds'),0,0,'C',1);
        // Movernos a la derecha
        $pdf->Cell(-15);
        $pdf->Cell(40,8,utf8_decode('Descripción'),0,0,'C',1);
        $pdf->Cell(110,8,utf8_decode('Precio'),0,0,'C',1);
        $pdf->Cell(-35,8,utf8_decode('Total'),0,1,'C',1);
        $pdf->Ln(3);

        $pdf->SetFont('Courier','B',12); 
        // Movernos a la derecha
        $pdf->Cell(13); 
        $pdf->Cell(38,8,'Entradas',0,1,'L',0);
        $pdf->Ln(3);
 
    // Entradas
    $pdf->SetFont('Courier','',12); 
    if($boleto1['CANTIDAD']>0){
        //boleto 1
        $pdf->Cell(38,8,$boleto1['CANTIDAD'],0,0,'C',0);
        $pdf->Cell(-10);
        $pdf->Cell(70,8,$boleto1['NOMBRE_BOLETO'],0,0,'L',0);
        $pdf->Cell(2);
        $pdf->Cell(38,8,'L '.number_format($boleto1['PRECIO'],2),0,0,'C',0);
        $pdf->Cell(38,8,'L '.number_format($boleto1['TOTAL'],2),0,1,'C',0);
        $pdf->Ln(3);
    }
    if($boleto2['CANTIDAD']>0){
        //boleto 2
        $pdf->Cell(38,8,$boleto2['CANTIDAD'],0,0,'C',0);
        $pdf->Cell(-10);
        $pdf->Cell(70,8,$boleto2['NOMBRE_BOLETO'],0,0,'L',0);
        $pdf->Cell(38,8,'L '.number_format($boleto2['PRECIO'],2),0,0,'C',0);
        $pdf->Cell(38,8,'L '.number_format($boleto2['TOTAL'],2),0,1,'C',0);
    }
    


    $pdf->SetFont('Courier','B',12); 
    // Movernos a la derecha
    $pdf->Cell(14); 
    $pdf->Cell(38,8,'Alimentos y Bebidas',0,1,'L',0);
    $pdf->Ln(3);
    
    $pdf->SetFont('Courier','',12); 
    foreach($combos as $combo){
     $pdf->Cell(38,8,$combo['CANTIDAD'],0,0,'C',0);
     $pdf->Cell(-10);
     $pdf->Cell(70,8,$combo['NOMBRE_COMBO'],0,0,'L',0);
     $pdf->Cell(1);
     $pdf->Cell(38,8,'L '.number_format($combo['PRECIO'],2),0,0,'C',0);
     $pdf->Cell(38,8,'L '.number_format($combo['TOTAL'],2),0,1,'C',0);
     $pdf->Ln(3);
    }
    
    $pdf->SetFont('Courier','B',12); 
    $pdf->Cell(34);
    $pdf->Cell(165,16,utf8_decode('Subtotal'),0,0,'C',1);
    $pdf->Cell(-62);
    $pdf->Cell(38,15,'L '.number_format($total['SUBTOTAL'],2),0,0,'C',0);
    $pdf->Ln();
    $pdf->Cell(33);
    $pdf->SetFont('Courier','',12); 
    $pdf->Cell(165,3,utf8_decode('Descuento'),0,0,'C',1);
    $pdf->Cell(-58);
    $pdf->Cell(38,3,'L '.number_format($total['DESCUENTO'],2),0,0,'C',0);
    $pdf->Ln();
    $pdf->Cell(22);
    $pdf->Cell(165,12,utf8_decode('Cargo por Servicio'),0,0,'C',1);
    $pdf->Cell(-48);
    $pdf->Cell(38,12,'L '.number_format($pagoServicios,2),0,0,'C',0);
    $pdf->Ln();
    $pdf->SetFont('Courier','B',12);
    $pdf->Cell(28);
    $pdf->Cell(165,5,utf8_decode('Total a Pagar'),0,0,'C',1);
    $pdf->Cell(-55);
    $pdf->Cell(38,5,'L '.number_format($total['TOTAL'] + $pagoServicios,2),0,0,'C',0);
    $pdf->Output();
?>
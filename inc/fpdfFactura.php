<?php
    require_once "config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();

    // OBTENEMOS EL ID DEL USUARIO
    $id = $_SESSION['id_usuario'];

    //OBTENER EL ID DE LA ULTIMA COMPRA DEL USUARIO
    $query = "SELECT ID_FACTURA FROM FACTURA
    WHERE ID_USUARIO = '$id'
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
    GROUP BY DETALLE.ID_COMBO;";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $combos = $statement->fetchAll(PDO::FETCH_ASSOC);
    $resultado = $statement->rowCount();

    if($resultado>0){
        foreach($combos as $combo){
            echo $combo['NOMBRE_COMBO']." ".$combo['CANTIDAD']." ".$combo['PRECIO']." ".$combo['TOTAL'];
        }
    }

?>
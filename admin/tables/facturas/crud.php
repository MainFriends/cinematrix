<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Insertar registros
            $query = "SELECT ID_FACTURA, CONCAT(NOMBRE, ' ', APELLIDO) NOMBRE, METODO_PAGO, PROMOCION, SUBTOTAL, TOTAL, FECHA
            FROM FACTURA, USUARIO
            WHERE FACTURA.ID_USUARIO = USUARIO.ID_USUARIO";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
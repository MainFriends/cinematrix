<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $promo = (isset($_POST['promo'])) ? $_POST['promo'] : '';
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
    $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Progamar promoción
            $query = "CALL SP_ADD_PPROMO(?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $promo, PDO::PARAM_INT);
            $statement->bindParam(2, $fecha, PDO::PARAM_STR);
            $statement->bindParam(3, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //Actualizar programacion
            $query = "CALL SP_UPD_PPROMO(?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->bindParam(2, $promo, PDO::PARAM_INT);
            $statement->bindParam(3, $fecha, PDO::PARAM_STR);
            $statement->bindParam(4, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 3: //Eliminar progamacion
            $query = "DELETE FROM PROGRAMACION_PROMO WHERE ID_PPROMO = '$id'";
            $statement = $conexion->prepare($query);
            $statement->execute();
            break;
        case 4: //Insertar registros
            $query = "SELECT * FROM PROGRAMACION_PROMO";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
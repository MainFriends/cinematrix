<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $numAsiento = (isset($_POST['numAsiento'])) ? $_POST['numAsiento'] : '';
    $sala = (isset($_POST['sala'])) ? $_POST['sala'] : '';
    $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Añadir un nuevo asiento
            $query = "CALL SP_ADD_ASIENTO(?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $numAsiento, PDO::PARAM_STR);
            $statement->bindParam(2, $sala, PDO::PARAM_INT);
            $statement->bindParam(3, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //Actualizar asiento
            $query = "CALL SP_UPD_ASIENTO(?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->bindParam(2, $numAsiento, PDO::PARAM_STR);
            $statement->bindParam(3, $sala, PDO::PARAM_INT);
            $statement->bindParam(4, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 3: //Eliminar asiento
            $query = "DELETE FROM ASIENTO WHERE ID_ASIENTO = '$id'";
            $statement = $conexion->prepare($query);
            $statement->execute();
            break;
        case 4: //Insertar registros
            $query = "SELECT * FROM ASIENTO";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
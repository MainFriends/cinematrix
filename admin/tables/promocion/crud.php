<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $descuento = (isset($_POST['descuento'])) ? $_POST['descuento'] : '';
    $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Añadir un nueva promoción
            $query = "CALL SP_ADD_PROMO(?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $nombre, PDO::PARAM_STR);
            $statement->bindParam(2, $descuento, PDO::PARAM_STR);
            $statement->bindParam(3, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //Actualizar promoción
            $query = "CALL SP_UPD_PROMO(?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->bindParam(2, $nombre, PDO::PARAM_STR);
            $statement->bindParam(3, $descuento, PDO::PARAM_STR);
            $statement->bindParam(4, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 3: //Eliminar promoción
            $query = "DELETE FROM PROMOCION WHERE ID_PROMO = '$id'";
            $statement = $conexion->prepare($query);
            $statement->execute();
            break;
        case 4: //Insertar registros
            $query = "SELECT * FROM PROMOCION";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $promo = (isset($_POST['promo'])) ? $_POST['promo'] : '';
    $fechaI = (isset($_POST['fechaI'])) ? $_POST['fechaI'] : '';
    $fechaF = (isset($_POST['fechaF'])) ? $_POST['fechaF'] : '';
    $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Progamar promoción
            $query = "CALL SP_ADD_PPROMO(?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $promo, PDO::PARAM_INT);
            $statement->bindParam(2, $fechaI, PDO::PARAM_STR);
            $statement->bindParam(3, $fechaF, PDO::PARAM_STR);
            $statement->bindParam(4, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //Actualizar programacion
            $query = "CALL SP_UPD_PPROMO(?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->bindParam(2, $promo, PDO::PARAM_INT);
            $statement->bindParam(3, $fechaI, PDO::PARAM_STR);
            $statement->bindParam(4, $fechaF, PDO::PARAM_STR);
            $statement->bindParam(5, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 3: //Eliminar progamacion
            $query = "DELETE FROM PROGRAMACION_PROMO WHERE ID_PPROMO = '$id'";
            $statement = $conexion->prepare($query);
            $statement->execute();
            break;
        case 4: //Insertar registros
            $query = "SELECT ID_PPROMO, NOMBRE PROMOCION, FECHA_INICIO, FECHA_FIN, ESTADO.DESCRIPCION ESTADO 
            FROM PROGRAMACION_PROMO, PROMOCION, ESTADO
            WHERE PROGRAMACION_PROMO.ID_PROMO = PROMOCION.ID_PROMO
            AND PROGRAMACION_PROMO.ID_ESTADO = ESTADO.ID_ESTADO";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
        case 5:
            $query = "SELECT * FROM PROGRAMACION_PROMO
            WHERE ID_PPROMO = ?";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
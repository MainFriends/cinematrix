<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
    $genero = (isset($_POST['genero'])) ? $_POST['genero'] : '';
    $clasificacion = (isset($_POST['clasificacion'])) ? $_POST['clasificacion'] : '';
    $sinopsis = (isset($_POST['sinopsis'])) ? $_POST['sinopsis'] : '';
    $duracion = (isset($_POST['duracion'])) ? $_POST['duracion'] : '';
    $año = (isset($_POST['año'])) ? $_POST['año'] : '';
    $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
    $portada = (isset($_POST['portada'])) ? $_POST['portada'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Añadir una nueva pelicula
            $query = "CALL SP_ADD_PELICULA(?,?,?,?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $titulo, PDO::PARAM_STR);
            $statement->bindParam(2, $duracion, PDO::PARAM_STR);
            $statement->bindParam(3, $genero, PDO::PARAM_INT);
            $statement->bindParam(4, $clasificacion, PDO::PARAM_INT);
            $statement->bindParam(5, $año, PDO::PARAM_STR);
            $statement->bindParam(6, $sinopsis, PDO::PARAM_STR);
            $statement->bindParam(7, $portada, PDO::PARAM_STR);
            $statement->bindParam(8, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //Actualizar pelicula
            $query = "CALL SP_UPD_PELICULA(?,?,?,?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->bindParam(2, $titulo, PDO::PARAM_STR);
            $statement->bindParam(3, $duracion, PDO::PARAM_STR);
            $statement->bindParam(4, $genero, PDO::PARAM_INT);
            $statement->bindParam(5, $clasificacion, PDO::PARAM_INT);
            $statement->bindParam(6, $año, PDO::PARAM_STR);
            $statement->bindParam(7, $sinopsis, PDO::PARAM_STR);
            $statement->bindParam(8, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 3: //Eliminar pelicula
            $query = "DELETE FROM PELICULA WHERE ID_PELICULA = '$id'";
            $statement = $conexion->prepare($query);
            $statement->execute();
            break;
        case 4: //Insertar registros
            $query = "SELECT * FROM PELICULA";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
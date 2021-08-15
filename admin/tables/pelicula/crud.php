<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
    $sinopsis = (isset($_POST['sinopsis'])) ? $_POST['sinopsis'] : '';
    $duracion = (isset($_POST['duracion'])) ? $_POST['duracion'] : '';
    $reparto = (isset($_POST['reparto'])) ? $_POST['reparto'] : '';
    $director = (isset($_POST['director'])) ? $_POST['director'] : '';
    $año = (isset($_POST['año'])) ? $_POST['año'] : '';
    $clasificacion = (isset($_POST['clasificacion'])) ? $_POST['clasificacion'] : '';
    $genero = (isset($_POST['genero'])) ? $_POST['genero'] : '';
    $portada = (isset($_POST['portada'])) ? $_POST['portada'] : '';
    $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
    

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Añadir una nueva pelicula
            $query = "CALL SP_ADD_PELICULA(?,?,?,?,?,?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $titulo, PDO::PARAM_STR);
            $statement->bindParam(2, $sinopsis, PDO::PARAM_STR);
            $statement->bindParam(3, $duracion, PDO::PARAM_INT);
            $statement->bindParam(4, $reparto, PDO::PARAM_STR);
            $statement->bindParam(5, $director, PDO::PARAM_STR);
            $statement->bindParam(6, $año, PDO::PARAM_STR);
            $statement->bindParam(7, $clasificacion, PDO::PARAM_INT);
            $statement->bindParam(8, $genero, PDO::PARAM_INT);
            $statement->bindParam(9, $portada, PDO::PARAM_STR);
            $statement->bindParam(10, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //Actualizar pelicula
            $query = "CALL SP_UPD_PELICULA(?,?,?,?,?,?,?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->bindParam(2, $titulo, PDO::PARAM_STR);
            $statement->bindParam(3, $sinopsis, PDO::PARAM_STR);
            $statement->bindParam(4, $duracion, PDO::PARAM_INT);
            $statement->bindParam(5, $reparto, PDO::PARAM_STR);
            $statement->bindParam(6, $director, PDO::PARAM_STR);
            $statement->bindParam(7, $año, PDO::PARAM_STR);
            $statement->bindParam(8, $clasificacion, PDO::PARAM_INT);
            $statement->bindParam(9, $genero, PDO::PARAM_INT);
            $statement->bindParam(10, $portada, PDO::PARAM_STR);
            $statement->bindParam(11, $estado, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 3: //Eliminar pelicula
            $query = "DELETE FROM PELICULA WHERE ID_PELICULA = '$id'";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->rowCount();
            break;
        case 4: //Insertar registros
            $query = "SELECT PELICULA.ID_PELICULA, TITULO, substring(SINOPSIS, 1, 50) SINOPSIS, DURACION, REPARTO, DIRECTOR, AÑO, GENERO, CLASIFICACION, ESTADO.DESCRIPCION ESTADO, PORTADA
            FROM PELICULA, GENERO, CLASIFICACION, ESTADO
            WHERE PELICULA.ID_GENERO = GENERO.ID_GENERO
            AND PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION
            AND PELICULA.ID_ESTADO = ESTADO.ID_ESTADO";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
        case 5:
            $query = "SELECT ID_PELICULA, TITULO, SINOPSIS, DURACION, REPARTO, DIRECTOR, AÑO, ID_GENERO, ID_CLASIFICACION, ID_ESTADO, PORTADA
            FROM PELICULA
            WHERE PELICULA.ID_PELICULA = ?";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
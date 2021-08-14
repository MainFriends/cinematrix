<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $pelicula = (isset($_POST['pelicula'])) ? $_POST['pelicula'] : '';
    $sala = (isset($_POST['sala'])) ? $_POST['sala'] : '';
    $horaInicio = (isset($_POST['horaInicio'])) ? $_POST['horaInicio'] : '';
    $horaFin = (isset($_POST['horaFin'])) ? $_POST['horaFin'] : '';
    $idioma = (isset($_POST['idioma'])) ? $_POST['idioma'] : '';
    $formato = (isset($_POST['formato'])) ? $_POST['formato'] : '';
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Añadir una nueva cartelera
            $query = "CALL SP_ADD_CARTELERA(?,?,?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $pelicula, PDO::PARAM_INT);
            $statement->bindParam(2, $sala, PDO::PARAM_INT);
            $statement->bindParam(3, $horaInicio, PDO::PARAM_STR);
            $statement->bindParam(4, $horaFin, PDO::PARAM_STR);
            $statement->bindParam(5, $idioma, PDO::PARAM_INT);
            $statement->bindParam(6, $formato, PDO::PARAM_INT);
            $statement->bindParam(7, $fecha, PDO::PARAM_STR);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //Actualizar cartelera
            $query = "CALL SP_UPD_CARTELERA(?,?,?,?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->bindParam(2, $pelicula, PDO::PARAM_INT);
            $statement->bindParam(3, $sala, PDO::PARAM_INT);
            $statement->bindParam(4, $horaInicio, PDO::PARAM_STR);
            $statement->bindParam(5, $horaFin, PDO::PARAM_STR);
            $statement->bindParam(6, $idioma, PDO::PARAM_INT);
            $statement->bindParam(7, $formato, PDO::PARAM_INT);
            $statement->bindParam(8, $fecha, PDO::PARAM_STR);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 3: //Eliminar cartelera
            $query = "DELETE FROM CARTELERA WHERE ID_CARTELERA = '$id'";
            $statement = $conexion->prepare($query);
            $statement->execute();

            //Quitar el estado de la pelicula en cartelera
            $queryD = "UPDATE PELICULA SET ID_ESTADO = 1 WHERE ID_PELICULA = '$pelicula'";
            $stmt = $conexion->prepare($queryD);
            $stmt->execute();
            break;
        case 4: //Insertar registros
            $query = "SELECT CARTELERA.ID_CARTELERA, TITULO, HORA_INICIO, HORA_FIN, SALA.NOMBRE SALA, IDIOMA.NOMBRE IDIOMA, FORMATO, FECHA
            FROM PELICULA, IDIOMA, FORMATO, CARTELERA, SALA
            WHERE CARTELERA.ID_PELICULA = PELICULA.ID_PELICULA
            AND CARTELERA.ID_IDIOMA = IDIOMA.ID_IDIOMA
            AND CARTELERA.ID_FORMATO = FORMATO.ID_FORMATO
            AND CARTELERA.ID_SALA = SALA.ID_SALA";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
        case 5:
            $query = "SELECT * FROM CARTELERA WHERE ID_CARTELERA = ?";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
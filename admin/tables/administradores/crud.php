<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
    $correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
    $pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';
    $tel = (isset($_POST['tel'])) ? $_POST['tel'] : '';
    $city = (isset($_POST['city'])) ? $_POST['city'] : '';
    $pais = (isset($_POST['pais'])) ? $_POST['pais'] : '';
    $date = (isset($_POST['date'])) ? $_POST['date'] : '';
    $genero = (isset($_POST['genero'])) ? $_POST['genero'] : 'M';
    $rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Add administrador
            $query = "CALL SP_REGISTRO_ADMINISTRADOR(?,?,?,?,?,?,?,?,?)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $nombre, PDO::PARAM_STR);
            $statement->bindParam(2, $apellido, PDO::PARAM_STR);
            $statement->bindParam(3, $correo, PDO::PARAM_STR);
            $statement->bindParam(4, $pass, PDO::PARAM_STR);
            $statement->bindParam(5, $genero, PDO::PARAM_STR);
            $statement->bindParam(6, $tel, PDO::PARAM_INT);
            $statement->bindParam(7, $date, PDO::PARAM_STR);
            $statement->bindParam(8, $pais, PDO::PARAM_STR);
            $statement->bindParam(9, $city, PDO::PARAM_STR);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //RELLENAR MODAL
            $query = "SELECT ID_ROL FROM LOGIN
            WHERE ID_USUARIO = '$id'";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
        case 3: //Insertar registros
            $query = "SELECT USUARIO.ID_USUARIO ID_USUARIO, USUARIO.NOMBRE NOMBRE, APELLIDO, USUARIO.CORREO CORREO, ROLES.NOMBRE ROL, TELEFONO, FECHA_NACIMIENTO, PAIS, CIUDAD
            FROM USUARIO, PAIS, LOGIN, ROLES 
            WHERE USUARIO.ID_PAIS = PAIS.ID_PAIS
            AND USUARIO.ID_USUARIO = LOGIN.ID_USUARIO
            AND ROLES.ID_ROL = LOGIN.ID_ROL
            AND LOGIN.ID_ROL = 1";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
        case 4:
            $query = "UPDATE LOGIN SET ID_ROL = ? WHERE ID_USUARIO = ?";
            $statement = $conexion->prepare($query);
            $statement->bindParam(1, $rol, PDO::PARAM_INT);
            $statement->bindParam(2, $id, PDO::PARAM_INT);
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC); //Leno el Array Data
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
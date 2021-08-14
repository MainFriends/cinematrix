<?php
    include_once "../../../inc/config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //Recepción de los datos enviados mediante el metodo POST desde js
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1: //Actualizar rol de usuario
            $query = "UPDATE LOGIN SET ID_ROL = :rol
            WHERE ID_USUARIO = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':rol', $rol);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
            break;
        case 2: //Insertar registros
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
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    
    $conexion=null;
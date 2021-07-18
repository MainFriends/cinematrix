<?php
    require_once "config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    if(isset($_POST["registrarse"])) {
        // Guardamos los datos en variables
        $nombre = $_POST["nombre"];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        $sexo = $_POST['sexo'];
        $telefono = $_POST['telefono'];
        $fecha_nacimiento = $_POST['date'];
        $pais = $_POST['pais'];
        $ciudad = $_POST['ciudad'];
        try {

            // Usamos el SP de la base de datos y enviamos mediante sentencia preparada.
            $sql_registro = "CALL SP_REGISTRO_USUARIO(?,?,?,?,?,?,?,?,?)";
            $statement = $conexion->prepare($sql_registro);
            $statement->bindParam(1, $nombre, PDO::PARAM_STR);
            $statement->bindParam(2, $apellido, PDO::PARAM_STR);
            $statement->bindParam(3, $correo, PDO::PARAM_STR);
            $statement->bindParam(4, $pass, PDO::PARAM_STR);
            $statement->bindParam(5, $sexo, PDO::PARAM_STR);
            $statement->bindParam(6, $telefono, PDO::PARAM_INT);
            $statement->bindParam(7, $fecha_nacimiento, PDO::PARAM_STR);
            $statement->bindParam(8, $pais, PDO::PARAM_INT);
            $statement->bindParam(9, $ciudad, PDO::PARAM_STR);
            $statement->execute();

            echo "<div class='alert alert-success text-center' role='alert'>
            <strong>¡Felicidades!</strong> Te has registrado correctamente.
            </div>";
        
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger text-center' role='alert'>
            <strong>¡Error!</strong> El correo ingresado se encuentra registrado. Intenta nuevamente con otro.
            </div>";
        }
    }
?>
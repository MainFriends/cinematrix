<?php
 require_once "config.php";
 $objeto = new Conexion();
$conexion = $objeto->Conectar();

//EDITAR PERFIL
 if(isset($_POST['editar'])){

    $id = $_SESSION['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];

    $sql = "CALL SP_UPD_PERFIL(?,?,?,?,?,?)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->bindParam(2, $nombre, PDO::PARAM_STR);
    $statement->bindParam(3, $apellido, PDO::PARAM_STR);
    $statement->bindParam(4, $correo, PDO::PARAM_STR);
    $statement->bindParam(5, $ciudad, PDO::PARAM_STR);
    $statement->bindParam(6, $pais, PDO::PARAM_INT);
    $statement->execute();
    $resultado = $statement->rowCount(); //Obtener numero de filas afectadas

    //Sobreescribimos los nuevos datos de la sesion
    if($resultado==1){
        $USER = $statement->fetch(PDO::FETCH_ASSOC); //Llenamos un array con la consulta
        $_SESSION['id_usuario'] = $USER["ID_USUARIO"];
        $_SESSION['usuario'] = $USER["NOMBRE"];
        $_SESSION['apellido'] = $USER["APELLIDO"];
        $_SESSION['rol'] = $USER["ID_ROL"];
        $_SESSION['correo'] = $USER["CORREO"];
        $_SESSION['pais'] = $USER["PAIS"];
        $_SESSION['ciudad'] = $USER["CIUDAD"];
        $_SESSION['date'] = $USER["FECHA_NACIMIENTO"];
        $_SESSION['confirm'] = 'true';
        header("location:account.php");
        echo "<div class='alert alert-success alert-dismissible  text-center fade show' role='alert'>
        <strong>¡Felicidades!</strong> Se han guardado tus cambios.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}

if(isset($_POST['changePass'])){

    $id = $_SESSION['id_usuario'];
    $pass = $_POST['pass'];
    $newPass = $_POST['newPass'];

    try {
    $query = "CALL SP_UPD_PASS(?,?,?)";
    $statement = $conexion->prepare($query);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->bindParam(2, $pass, PDO::PARAM_STR);
    $statement->bindParam(3, $newPass, PDO::PARAM_STR);
    $statement->execute();

    echo "<div class='alert alert-success alert-dismissible  text-center fade show' role='alert'>
        <strong>¡Felicidades!</strong> Has cambiado tu contraseña correctamente.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";

    } catch (PDOException $e) {
        echo "<div class='alert alert-danger alert-dismissible  text-center fade show' role='alert'>
        <strong>¡Ups!</strong> La contraseña ingresada es invalida.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }



}

?>
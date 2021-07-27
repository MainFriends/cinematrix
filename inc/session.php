<?php
    require_once "config.php";
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
   if(isset($_POST["login"])) {
       // Guardamos los datos en variables
       $correo = $_POST['correo'];
       $pass = $_POST['pass'];
   
       // Usamos el SP de la base de datos y enviamos mediante sentencia preparada.
       $sql_login = "CALL SP_LOGIN_USUARIO(?,?)";
       $statement = $conexion->prepare($sql_login);
       $statement->execute(array($correo,$pass));
       $resultado = $statement->rowCount(); //Obtener numero de filas afectadas

       //Validamos el inicio de sesión
       if($resultado==1){
          $USER = $statement->fetch(PDO::FETCH_ASSOC); //Llenamos un array con la consulta
            if($USER["ID_ROL"] == 1){ //Administrador
                 session_start(); //Iniciamos la sesión
                 $_SESSION['usuario'] = $USER["NOMBRE"];
                 $_SESSION['apellido'] = $USER["APELLIDO"];
                 $_SESSION['rol'] = $USER["ID_ROL"];
                 
                if($_SESSION['pag']=='index'){
                    header("location:index.php");
                }else if($_SESSION['pag']=='promociones'){
                    header("location:promociones.php");
                }else if($_SESSION['pag']=='detallePromo'){
                    header("location:detallePromo.php");
                }else if($_SESSION['pag']=='login'){
                    header("location:admin/tables/usuarios/index.php");
                }
            }else{ //Cliente
                 session_start(); //Iniciamos la sesión
                 $_SESSION['usuario'] = $USER["NOMBRE"];
                 $_SESSION['apellido'] = $USER["APELLIDO"];
                 $_SESSION['rol'] = $USER["ID_ROL"];
                if($_SESSION['pag']=='login'){
                    header("location:index.php");
                }
            }
            
        }else{
             echo "<div class='alert alert-danger text-center'>
                     <strong>¡Ups!</strong> El correo o la contraseña que ingresaste no coinciden con nuestros registros. Por favor, revisa e inténtalo de nuevo.
                  </div>";  
        }
    }
?>
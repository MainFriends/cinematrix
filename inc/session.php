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
                //Iniciar las variables de la sesión
                 session_start();
                 $_SESSION['id_usuario'] = $USER["ID_USUARIO"];
                 $_SESSION['usuario'] = $USER["NOMBRE"];
                 $_SESSION['apellido'] = $USER["APELLIDO"];
                 $_SESSION['rol'] = $USER["ID_ROL"];
                 $_SESSION['correo'] = $USER["CORREO"];
                 $_SESSION['pais'] = $USER["PAIS"];
                 $_SESSION['ciudad'] = $USER["CIUDAD"];
                 $_SESSION['date'] = $USER["FECHA_NACIMIENTO"];
                 
                 //Redirecciones segun pagina actual
                if($_SESSION['pag']=='index'){
                    header("location:index.php");
                }else if($_SESSION['pag']=='promociones'){
                    header("location:promociones.php");
                }else if($_SESSION['pag']=='detallePromo'){
                    header("location:detallePromo.php");
                }else if($_SESSION['pag']=='login'){
                    header("location:admin/tables/usuarios/index.php");
                }else if($_SESSION['pag']=='cartelera'){
                    header("location:cartelera.php");
                }else if($_SESSION['pag']=='pelicula'){
                    header("location:pelicula.php");
                }else if($_SESSION['pag']=='peliculas'){
                    header("location:peliculas.php");
                }
            }else{ //Cliente
                //Iniciar las variables de la sesión
                 session_start();
                 $_SESSION['id_usuario'] = $USER["ID_USUARIO"];
                 $_SESSION['usuario'] = $USER["NOMBRE"];
                 $_SESSION['apellido'] = $USER["APELLIDO"];
                 $_SESSION['rol'] = $USER["ID_ROL"];
                 $_SESSION['correo'] = $USER["CORREO"];
                 $_SESSION['pais'] = $USER["PAIS"];
                 $_SESSION['ciudad'] = $USER["CIUDAD"];
                 $_SESSION['date'] = $USER["FECHA_NACIMIENTO"];
                 
                 //Redirecciones segun pagina actual
                if($_SESSION['pag']=='index'){
                    header("location:index.php");
                }else if($_SESSION['pag']=='promociones'){
                    header("location:promociones.php");
                }else if($_SESSION['pag']=='detallePromo'){
                    header("location:detallePromo.php");
                }else if($_SESSION['pag']=='cartelera'){
                    header("location:cartelera.php");
                }else if($_SESSION['pag']=='pelicula'){
                    header("location:pelicula.php");
                }else if($_SESSION['pag']=='peliculas'){
                    header("location:peliculas.php");
                }
            }
            
        }else{
            header("location:login.php?error=true"); 
        }
    }
?>
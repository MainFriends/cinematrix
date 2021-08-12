<?php
        setlocale(LC_TIME, 'Spanish');      
        session_start();
        require_once 'inc/session.php';
        $_SESSION['pag'] = 'pelicula';
        if(isset($_SESSION['usuario'])){
            $userSession = $_SESSION['usuario'];
            $userId = $_SESSION['id_usuario'];
            $userEmail = $_SESSION['correo'];

            $query = "SELECT FOTO_PERFIL FROM USUARIO where ID_USUARIO = '$userId'";
            $stm = $conexion->prepare($query);
            $stm->execute();
            $foto = $stm->fetch(PDO::FETCH_ASSOC);
            $foto_perfil = $foto['FOTO_PERFIL'];
        }

        //Obtenemos el id de la cartelera
        $id = $_GET['id'];

        //Obtenemos los asientos del usuario
        $userAsientos = $_SESSION['butacas'];

        //Obtenemos los combos del usuario
        $combo1 = $_SESSION['COMBO1'];
        $combo2 = $_SESSION['COMBO2'];
        $combo3 = $_SESSION['COMBO3'];
        $combo4 = $_SESSION['COMBO4'];
        $combo5 = $_SESSION['COMBO5'];
        $combo6 = $_SESSION['COMBO6'];
        $combo7 = $_SESSION['COMBO7'];

        //CONSULTA CARTELERA
        $query = "SELECT CARTELERA.ID_PELICULA, PORTADA, FORMATO, TITULO, FECHA, DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO
        FROM PELICULA, CARTELERA, FORMATO
        WHERE PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
        AND CARTELERA.ID_FORMATO = FORMATO.ID_FORMATO
        AND ID_CARTELERA = '$id'";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);

        $fechaES = utf8_encode(strftime('%A %d %B %Y', strtotime($data['FECHA'])));

        //CONSULTA ASIENTOS
        $query = "SELECT * FROM ASIENTO";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $asientos = $stm->fetchAll(PDO::FETCH_ASSOC);

        //CONSULTA SNACKS
        $query = "SELECT * FROM COMBO";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $snacks = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alimentos y bebidas - Cinematrix</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- FONT -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- ICONOS -->
   <script src="https://kit.fontawesome.com/151b334714.js" crossorigin="anonymous"></script>

    <style type="text/css">
    a{
	    text-decoration:none;
    }

    body{
    font-family: 'Poppins';
    }
  </style>
</head>

<body>
  <div class="container-fluid"> <!-- CONTAINER PRINCIPAL -->
    <!-- NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
         <div class="container-fluid">
            <a href="index.php"><img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="70" alt=""></a>
            <span class="me-2 fs-3 fw-bold mb-0"><a class="fw-bold text-dark" href="index.php">Cinematrix</a></span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
               data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
               aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="mb-0 collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="peliculas.php">PELÍCULAS</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="cartelera.php">CARTELERA</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="promociones.php" tabindex="-1" aria-disabled="true">PROMOCIONES</a>
                  </li>
               </ul>
               <?php
                  if(isset($_SESSION['usuario'])){
                     $userApellido = $_SESSION["apellido"];
                     if($_SESSION['rol']==1){
                      echo "<div class='nav-item dropdown'>
                      <a class='nav-link text-dark dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        <img src='data:image/jpeg;base64,".base64_encode($foto['FOTO_PERFIL']) ." ' width='35px' height='35px' class='rounded-circle me-2' alt=''>
                        <span class='fw-bold'>$userSession $userApellido</span>
                      </a>
                      <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>
                        <li><a class='dropdown-item' href='admin/tables/usuarios/index.php'><i class='fas fa-tachometer-alt me-2'></i>Dashboard</a></li>
                        <li><a class='dropdown-item' href='account.php'><i class='fas fa-user-edit me-2'></i>Editar perfil</a></li>
                        <li><a class='dropdown-item' href='inc/logout.php'><i class='fas fa-sign-out-alt me-2'></i>Cerrar sesión</a></li>
                      </ul>
                   </div>";
                   }else{
                      echo "<div class='nav-item dropdown'>
                      <a class='nav-link text-dark dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        <img src='data:image/jpeg;base64,".base64_encode($foto['FOTO_PERFIL']) ." ' width='35px' height='35px' class='rounded-circle me-2' alt=''>
                        <span class='fw-bold'>$userSession $userApellido</span>
                      </a>
                      <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>
                        <li><a class='dropdown-item' href='account.php'><i class='fas fa-user-edit me-2'></i>Editar perfil</a></li>
                        <li><a class='dropdown-item' href='inc/logout.php'><i class='fas fa-sign-out-alt me-2'></i>Cerrar sesión</a></li>
                      </ul>
                   </div>";
                   }
                  }else{
                    echo '<div class="nav-item dropdown">
                    <a class="btn btn-danger dropdown" href="#" role="button" id="dropdownMenuLink"
                       data-bs-toggle="dropdown" aria-expanded="false">
                       Ingresar
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="width: 300px" aria-labelledby="navbarDropdown">
                       <form class="px-4 py-1" method="POST">
                          <label class="label-control" for="">Correo electrónico</label>
                          <input class="form-control" name="correo" type="text">
                          <label class="label-control" for="">Contraseña</label>
                          <input class="form-control" name="pass" type="password">
                          <div class="py-1">
                             <input type="checkbox" name="connected" class="form-check-input">
                             <label for="connected" class="form-check-label">Mantenerme conectado</label>
                          </div>
                          <div class="py-1 d-grid">
                             <button type="submit" class=" d-grid btn btn-primary" name="login" >Iniciar sesión</button>
                          </div>
                          <p class="small">¿No tienes una cuenta? <a href="signup.php">Regístrate</a></p>
                       </form>
                    </ul>
                 </div>';
                  }
               ?>
            </div>
         </div>
      </nav>
      <!-- FIN NAV -->

      <!-- Cuerpo-->
      <div class="container px-0">
        <div class="row my-4">
          <!-- Columna descripción pelicula-->
          <div class="col-md-3">
            <div class="row">
                <img src="<?php echo $data['PORTADA'] ?>" alt="">
            </div>
            <div class="row mt-3">
                <h5 class="border-bottom text-danger">TITULO ORIGINAL</h5>
                <p class="text-muted"><?php echo $data['TITULO'] ?></p>
            </div>
            <div class="row">
                <h5 class="border-bottom text-danger">FORMATO</h5>
                <abbr title=""><button class="btn btn-warning btn-sm fw-bold" disabled><?php echo $data['FORMATO'] ?></button></abbr>
            </div>
            <div class="row mt-3">
                <h5 class="border-bottom text-danger">FECHA Y HORARIO</h5>
                <p class="small text-muted"><?php echo strtoupper($fechaES) ." " .$data['HORA_INICIO'] ?></p>   
            </div>
            <div class="row">
                <h5 class="border-bottom text-danger">ENTRADAS</h5>
                <?php
                if($_SESSION['cantADULTREGULAR']>0){
                    $cantidad = $_SESSION['cantADULTREGULAR'];
                    echo "<p class='small text-muted mb-0'>$cantidad ADULTREGULAR-HO</p>";
                }
                if($_SESSION['cantCINEPACKPAREJA2D']>0){
                    $cantidad = $_SESSION['cantCINEPACKPAREJA2D']/2;
                    echo "<p class='small text-muted'>$cantidad CINEPACKPAREJA2D-HN</p>";
                }
                ?>
            </div>
            <div class="row mt-2">
                <h5 class="border-bottom text-danger">BUTACAS</h5>
                <?php
                foreach($userAsientos as $asientosUser){
                    foreach($asientos as $butacas){
                        if($asientosUser == $butacas['ID_ASIENTO']){
                            $nombre = $butacas['NUM_ASIENTO'];
                            echo "
                            <div class='col-md-1'>
                                <span class='text-muted small'>$nombre</span>
                            </div>";
                        }
                    }
                }
                ?>
            </div>
            <div class="row mt-2">
                <h5 class="border-bottom text-danger">SNACKS</h5>
                <?php
                foreach($snacks as $combo){
                    if($combo1[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo1[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo2[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo2[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo3[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo3[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo4[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo4[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo5[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo5[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo6[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo6[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo7[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo7[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                }
                ?>
            </div>
            <div class="row mt-2">
                <h5 class="border-bottom text-danger">EMAIL</h5>
                <p class="small text-muted"><?php echo $userEmail?></p>
            </div>
          </div><!-- FIN Columna descripción pelicula-->
          <div class="col-md-9 px-0"><!-- Inicio columna boletos-->
           
          </div><!-- FIN Columna Boletos--> 
          <div class="text-end mt-4">
                <a href="snacks.php?id=<?php echo $id?>" class="btn btn-danger btn-sm mt-2">Volver</a>
                <a href="#" class="btn btn-danger btn-sm mt-2" id="continuar">Pagar</a>
            </div> 
        </div>        
      </div> 
        
      <!-- FIN Cuerpo-->
  </div> <!-- FIN CONTAINER PRINCIPAL -->
  <footer>
    <div class="container-fluid">
        <div class="row bg-light">
            <div class="col-md-4">
                <div class="text-center">
                    <img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="175" alt="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="text-start">
                    <h6 class="border-bottom">PROGRAMACIÓN</h6>
                </div>
                <a style="text-decoration:none" href="#" class="text-secondary">Cartelera</a> <br>
                <a style="text-decoration:none" href="#" class="text-secondary">Próximamente</a> <br>
                <a style="text-decoration:none" href="#" class="text-secondary">Preventa</a>
            </div>
            <div class="col-md-2">
                <div class="text-start">
                    <h6 class="border-bottom">SOBRE CINEMATRIX</h6>
                </div>
                <a style="text-decoration:none" href="#" class="text-secondary">¿Quienes somos?</a> <br>
                <a style="text-decoration:none" href="#" class="text-secondary">Términos y condiciones</a>
            </div>
            <div class="col-md-2">
                <div class="text-start">
                    <h6 class="border-bottom">CONTÁCTENOS</h6>
                </div>
                <a style="text-decoration:none" href="#" class="text-secondary">Escríbenos</a> <br>
                <a style="text-decoration:none" href="#" class="text-secondary">Trabaje con nosotros</a>
            </div>
        </div>
    </div>
  </footer>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.js"></script>
</body>
</html>
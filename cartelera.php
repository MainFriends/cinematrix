<?php 
  setlocale(LC_TIME, 'Spanish');      
  session_start();
  require_once 'inc/session.php';
  $_SESSION['pag'] = 'cartelera';
  if(isset($_SESSION['usuario'])){
      $userSession = $_SESSION['usuario'];
      $userId = $_SESSION['id_usuario'];

      $query = "SELECT FOTO_PERFIL FROM USUARIO where ID_USUARIO = '$userId'";
      $stm = $conexion->prepare($query);
      $stm->execute();
      $foto = $stm->fetch(PDO::FETCH_ASSOC);
      $foto_perfil = $foto['FOTO_PERFIL'];
  }

  // CARTELERA HOY
  $query = "SELECT DISTINCT TITULO, PELICULA.ID_PELICULA, PORTADA, CLASIFICACION, DURACION
  FROM PELICULA, CLASIFICACION, CARTELERA
  WHERE PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
  AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
  AND FECHA = CURDATE()";
  $stm = $conexion->prepare($query);
  $stm->execute();
  $data = $stm->fetchAll(PDO::FETCH_ASSOC);

  // FECHA HOY
  $query = "SELECT DISTINCT FECHA
  FROM CARTELERA
  WHERE FECHA = CURDATE()";
  $stm = $conexion->prepare($query);
  $stm->execute();
  $hoy = $stm->fetch(PDO::FETCH_ASSOC);
  //Le damos formato a la fecha que se mostrará en el card
  $dateConvertToday = utf8_encode(strftime('%a %d/%m/%Y', strtotime($hoy['FECHA'])));

  // RECOGER LAS FECHAS DESPUES DE HOY
  $queryf = "SELECT DISTINCT FECHA
  FROM CARTELERA
  WHERE FECHA > CURDATE()";
  $stm = $conexion->prepare($queryf);
  $stm->execute();
  $fecha = $stm->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carteleras - Cinematrix</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- ICONOS -->
  <script src="https://kit.fontawesome.com/151b334714.js" crossorigin="anonymous"></script>

  <style type="text/css">
    a{
	    text-decoration:none;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
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
                           <div class="py-2">
                              <input type="checkbox" name="connected" class="form-check-input">
                              <label for="connected" class="form-check-label">Mantenerme conectado</label>
                           </div>
                           <div class="py-2 d-grid">
                              <button type="submit" class=" d-grid btn btn-primary" name="login" >Iniciar sesión</button>
                           </div>
                        </form>
                     </ul>
                  </div>';
                  }
               ?>
            </div>
         </div>
      </nav>
    <!--CUERPO-->

       <!-- CARROUSEL CARTELERA-->
       <div class="container">
        <div class="row my-3 mx-1">
           <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                 <div class="carousel-item active">
                    <img src="https://static.cinepolis.com/img/front/9/2021714184950953-prin.jpg" class="d-block w-100" style="height: 300px;" alt="...">
                 </div>
                 <div class="carousel-item">
                    <img src="https://static.cinepolis.com/img/front/9/202172119174736-prin.jpg" class="d-block w-100" style="height: 300px;" alt="...">
                 </div>
                 <div class="carousel-item">
                    <img src="https://static.cinepolis.com/img/front/9/20217141477932-prin.jpg" class="d-block w-100" style="height: 300px;" alt="...">
                 </div>
              </div>
           </div>
        </div>
      </div>

    <div class="container">
          <!-- Tab panes -->
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-taquilla" role="tabpanel"
              aria-labelledby="pills-taquilla-tab">
              <div class="tab-content" id="pills-tabContent">
                <ul class="nav justify-content-center" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-dark btn-sm me-1" id="pills-lunesc-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-lunesc" type="button" role="tab" aria-controls="pills-lunesc"
                      aria-selected="true"><?php echo ucwords($dateConvertToday)?></button>
                  </li>
                  <?php   
                    foreach($fecha as $fechas){ // GENERAR LAS FECHAS SIGUIENTES
                      $dateConvert = utf8_encode(strftime('%a %d/%m/%Y', strtotime($fechas['FECHA'])));
                  ?>
                  <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-dark btn-sm me-1" id="pills-<?php echo $fechas['FECHA'] ?>-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-<?php echo $fechas['FECHA'] ?>" type="button" role="tab" aria-controls="pills-<?php echo $fechas['FECHA'] ?>"
                      aria-selected="false"><?php echo ucwords($dateConvert) ?></button>
                  </li>
                  <?php
                    }
                  ?>
                </ul>


                <div class="tab-pane fade show my-4 active" id="pills-lunesc" role="tabpanel" aria-labelledby="pills-lunesc-tab">
                    <?php
                      foreach($data as $datos){
                        $id = $datos['ID_PELICULA'];
                        $fechahoy = $hoy['FECHA'];

                        // DOBLADA AL ESPAÑOL
                        $queryDOB = "SELECT DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '$fechahoy'
                        AND ID_IDIOMA = 1";
                        $stm = $conexion->prepare($queryDOB);
                        $stm->execute();
                        $dataHI = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulDOB = $stm->rowCount(); //Obtenemos el numero de filas afectadas

                        // ORIGINAL/SUBTITULADA
                        $querySUB = "SELECT DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '$fechahoy'
                        AND ID_IDIOMA = 2";
                        $stm = $conexion->prepare($querySUB);
                        $stm->execute();
                        $dataSUB = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulSUB = $stm->rowCount();
                    ?>
                  <div class="row">
                    <div class="col-md-4">
                      <img src="<?php echo $datos['PORTADA']?>" class="rounded mx-auto d-block" width="50%"
                        alt="...">
                    </div>
                    <div class="col-md-8">
                      <h5 class="card-title"><?php echo $datos['TITULO']?></h5>
                      <div class="d-grid gap-2 d-md-block my-3">
                          <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled><?php echo $datos['CLASIFICACION']?></button></abbr>
                          <button class="btn btn-outline-secondary btn-sm" disabled><?php echo $datos['DURACION']?></button>
                      </div>
                        <!--TARJETA-->
                        <div class="card my-2">
                          <div class="card-header fw-bold">
                            Multiplaza Tegucigalpa
                          </div>
                          <div class="card-body">
                            <p class="card-text fw-lighter">*Los horarios aquí expuestos representan el inicio de cada función</p>
                        
                            <?php
                            // Si hay resultados para peliculas dobladas ejecuta esta sentencia
                            if($resulDOB >= 1){
                            ?>
                                <p class="fw-bold"><span class="badge bg-secondary">DOB</span>
                                    <?php foreach($dataHI as $HIDOB){?>
                                    <a href="#" class="btn btn-danger btn-sm"><?php echo $HIDOB['HORA_INICIO']?></a>
                                    <?php
                                    }
                                    ?>
                                </p>
                            <?php
                            }
                            ?>
                            <?php
                            // Si hay resultados para peliculas subtituladas ejecuta esta sentencia
                            if($resulSUB >= 1){
                            ?>
                                <p class="fw-bold"><span class="badge bg-secondary">SUB</span>
                                    <?php foreach($dataSUB as $HISUB){?>
                                    <a href="#" class="btn btn-danger btn-sm"><?php echo $HISUB['HORA_INICIO']?></a>
                                    <?php
                                    }
                                    ?>
                                </p>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                    </div> <!-- FIN COL-8 -->
                  
                  </div> <!-- FIN ROW -->
                    <?php
                      }
                    ?>
                </div> <!-- FIN TAB -->

                <?php //CARTELERAS DESPUES DE HOY
                foreach($fecha as $fechas2){
                  $fechaactual = $fechas2['FECHA'];
                  $query = "SELECT DISTINCT TITULO, PELICULA.ID_PELICULA, PORTADA, CLASIFICACION, DURACION
                  FROM PELICULA, CLASIFICACION, CARTELERA
                  WHERE PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
                  AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
                  AND FECHA = '$fechaactual'";
                  $stm = $conexion->prepare($query);
                  $stm->execute();
                  $dataA = $stm->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="tab-pane fade my-4" id="pills-<?php echo $fechas2['FECHA'] ?>" role="tabpanel"
                  aria-labelledby="pills-<?php echo $fechas2['FECHA'] ?>-tab">
                  <?php
                      foreach($dataA as $datos){
                        $id = $datos['ID_PELICULA'];;

                        // DOBLADA AL ESPAÑOL
                        $queryDOB = "SELECT DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '$fechaactual'
                        AND ID_IDIOMA = 1";
                        $stm = $conexion->prepare($queryDOB);
                        $stm->execute();
                        $dataHI = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulDOB = $stm->rowCount(); //Obtenemos el numero de filas afectadas

                        // ORIGINAL/SUBTITULADA
                        $querySUB = "SELECT DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '$fechaactual'
                        AND ID_IDIOMA = 2";
                        $stm = $conexion->prepare($querySUB);
                        $stm->execute();
                        $dataSUB = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulSUB = $stm->rowCount();
                    ?>
                  <div class="row my-3">
                    <div class="col-md-4">
                      <img src="<?php echo $datos['PORTADA']?>" class="rounded mx-auto d-block" width="50%"
                        alt="...">
                    </div>
                    <div class="col-md-8">
                      <h5 class="card-title"><?php echo $datos['TITULO']?></h5>
                      <div class="d-grid gap-2 d-md-block my-3">
                          <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled><?php echo $datos['CLASIFICACION']?></button></abbr>
                          <button class="btn btn-outline-secondary btn-sm" disabled><?php echo $datos['DURACION']?></button>
                      </div>
                        <!--TARJETA-->
                        <div class="card my-2">
                          <div class="card-header fw-bold">
                            Multiplaza Tegucigalpa
                          </div>
                          <div class="card-body">
                            <p class="card-text fw-lighter">*Los horarios aquí expuestos representan el inicio de cada función</p>
                        
                            <?php
                            // Si hay resultados para peliculas dobladas ejecuta esta sentencia
                            if($resulDOB >= 1){
                            ?>
                                <p class="fw-bold"><span class="badge bg-secondary">DOB</span>
                                    <?php foreach($dataHI as $HIDOB){?>
                                    <a href="#" class="btn btn-danger btn-sm"><?php echo $HIDOB['HORA_INICIO']?></a>
                                    <?php
                                    }
                                    ?>
                                </p>
                            <?php
                            }
                            ?>
                            <?php
                            // Si hay resultados para peliculas subtituladas ejecuta esta sentencia
                            if($resulSUB >= 1){
                            ?>
                                <p class="fw-bold"><span class="badge bg-secondary">SUB</span>
                                    <?php foreach($dataSUB as $HISUB){?>
                                    <a href="#" class="btn btn-danger btn-sm"><?php echo $HISUB['HORA_INICIO']?></a>
                                    <?php
                                    }
                                    ?>
                                </p>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                    </div> <!-- FIN COL-8 -->
                  
                  </div> <!-- FIN ROW -->
                    <?php
                      }
                    ?>
                </div>
                <?php
                  }
                ?>
          </div>
        </div>
      </div>
    </div>

    <!--FINAL DEL CUERPO-->
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
</body>

</html>
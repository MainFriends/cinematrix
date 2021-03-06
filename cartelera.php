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
  $query = "SELECT DISTINCT TITULO, PELICULA.ID_PELICULA, PORTADA, CLASIFICACION, DESCRIPCION, DURACION, GENERO
  FROM PELICULA, CLASIFICACION, CARTELERA, GENERO
  WHERE PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
  AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
  AND PELICULA.ID_GENERO = GENERO.ID_GENERO
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
  //Le damos formato a la fecha que se mostrarĂ¡ en el card
  $dateConvertToday = utf8_encode(strftime('%a %d/%m/%Y', strtotime($hoy['FECHA'])));

  // RECOGER LAS FECHAS DESPUES DE HOY
  $queryf = "SELECT DISTINCT FECHA
  FROM CARTELERA
  WHERE FECHA > CURDATE()
  ORDER BY FECHA ASC";
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
  <link rel="shortcut icon" href="assets/img/logos/cinematrix_ico.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

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
                     <a class="nav-link" aria-current="page" href="peliculas.php">PELĂ?CULAS</a>
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
                      <li><a class='dropdown-item' href='admin/graph/index.php'><i class='fas fa-tachometer-alt me-2'></i>Dashboard</a></li>
                        <li><a class='dropdown-item' href='account.php'><i class='fas fa-user-edit me-2'></i>Editar perfil</a></li>
                        <li><a class='dropdown-item' href='inc/logout.php'><i class='fas fa-sign-out-alt me-2'></i>Cerrar sesiĂ³n</a></li>
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
                        <li><a class='dropdown-item' href='inc/logout.php'><i class='fas fa-sign-out-alt me-2'></i>Cerrar sesiĂ³n</a></li>
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
                          <label class="label-control" for="">Correo electrĂ³nico</label>
                          <input class="form-control" name="correo" type="text">
                          <label class="label-control" for="">ContraseĂ±a</label>
                          <input class="form-control" name="pass" type="password">
                          <div class="py-1">
                             <input type="checkbox" name="connected" class="form-check-input">
                             <label for="connected" class="form-check-label">Mantenerme conectado</label>
                          </div>
                          <div class="py-1 d-grid">
                             <button type="submit" class=" d-grid btn btn-primary" name="login" >Iniciar sesiĂ³n</button>
                          </div>
                          <p class="small">Â¿No tienes una cuenta? <a href="signup.php">RegĂ­strate</a></p>
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
                 <div class="carousel-item active ms-3 mb-3">
                    <img src="assets/img/sliders/cartelera.jpg" class="d-block w-100 mx-5" height="300px" alt="...">
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

                        // DOBLADA AL ESPAĂ‘OL
                        $queryDOB = "SELECT ID_CARTELERA, DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '$fechahoy'
                        AND ID_IDIOMA = 1
                        AND HORA_INICIO > now()
                        ORDER BY HORA_INICIO";
                        $stm = $conexion->prepare($queryDOB);
                        $stm->execute();
                        $dataHI = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulDOB = $stm->rowCount(); //Obtenemos el numero de filas afectadas

                        // ORIGINAL/SUBTITULADA
                        $querySUB = "SELECT ID_CARTELERA, DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '$fechahoy'
                        AND ID_IDIOMA = 2
                        AND HORA_INICIO > now()
                        ORDER BY HORA_INICIO";
                        $stm = $conexion->prepare($querySUB);
                        $stm->execute();
                        $dataSUB = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulSUB = $stm->rowCount();
                    ?>
                  <div class="row mt-3">
                    <div class="col-md-4 text-center">
                      <a href="pelicula.php?id=<?php echo $id?>"><img src="<?php echo $datos['PORTADA']?>" class="rounded mx-auto" width="200px" height="300px" alt="..."></a>
                    </div>
                    <div class="col-md-8">
                      <h5 class="card-title"><?php echo $datos['TITULO']?></h5>
                      <div class="d-grid gap-2 d-md-block my-3">
                          <abbr title="<?php echo $datos['CLASIFICACION']?>"><button class="btn btn-warning btn-sm" disabled><?php echo $datos['CLASIFICACION']?></button></abbr>
                          <button class="btn btn-outline-secondary btn-sm" disabled><?php echo $datos['DURACION']?></button>
                          <button class="btn btn-outline-secondary btn-sm" disabled><?php echo $datos['GENERO']?></button>
                      </div>
                        <!--TARJETA-->
                        <div class="card my-2">
                          <div class="card-header fw-bold">
                            Multiplaza Tegucigalpa
                          </div>
                          <div class="card-body">
                          <?php if($resulSUB >= 1 || $resulDOB >= 1){
                              echo "<p class='card-text fw-lighter text-muted small'>*Los horarios aquĂ­ expuestos representan el inicio de cada funciĂ³n</p>";
                            }else{
                              echo "<p class='card-text fw-lighter text-muted small'>*No hay funciones disponibles para hoy</p>";
                            }
                            ?>
                            <?php
                            // Si hay resultados para peliculas dobladas ejecuta esta sentencia
                            if($resulDOB >= 1){
                            ?>
                                <p class="fw-bold"><span class="badge bg-secondary">DOB</span>
                                    <?php foreach($dataHI as $HIDOB){?>
                                    <a href="boletos.php?id=<?php echo $HIDOB['ID_CARTELERA']?>" class="btn btn-danger btn-sm"><?php echo $HIDOB['HORA_INICIO']?></a>
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
                                    <a href="boletos.php?id=<?php echo $HISUB['ID_CARTELERA']?>" class="btn btn-danger btn-sm"><?php echo $HISUB['HORA_INICIO']?></a>
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
                  $query = "SELECT DISTINCT TITULO, PELICULA.ID_PELICULA, PORTADA, CLASIFICACION, DESCRIPCION, DURACION, GENERO
                  FROM PELICULA, CLASIFICACION, CARTELERA, GENERO
                  WHERE PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
                  AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
                  AND PELICULA.ID_GENERO = GENERO.ID_GENERO
                  AND FECHA = '$fechaactual'";
                  $stm = $conexion->prepare($query);
                  $stm->execute();
                  $dataA = $stm->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="tab-pane fade my-4" id="pills-<?php echo $fechas2['FECHA'] ?>" role="tabpanel"
                  aria-labelledby="pills-<?php echo $fechas2['FECHA'] ?>-tab">
                  <?php
                      foreach($dataA as $datos){
                        $id = $datos['ID_PELICULA'];

                        // DOBLADA AL ESPAĂ‘OL
                        $queryDOB = "SELECT ID_CARTELERA, DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '$fechaactual'
                        AND ID_IDIOMA = 1
                        ORDER BY HORA_INICIO";
                        $stm = $conexion->prepare($queryDOB);
                        $stm->execute();
                        $dataHI = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulDOB = $stm->rowCount(); //Obtenemos el numero de filas afectadas

                        // ORIGINAL/SUBTITULADA
                        $querySUB = "SELECT ID_CARTELERA, DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '$fechaactual'
                        AND ID_IDIOMA = 2
                        ORDER BY HORA_INICIO";
                        $stm = $conexion->prepare($querySUB);
                        $stm->execute();
                        $dataSUB = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulSUB = $stm->rowCount();
                    ?>
                  <div class="row my-3">
                    <div class="col-md-4 text-center">
                      <a href="pelicula.php?id=<?php echo $id?>"><img src="<?php echo $datos['PORTADA']?>" class="rounded mx-auto" width="200px" height="300px" alt="..."></a>
                    </div>
                    <div class="col-md-8">
                      <h5 class="card-title"><?php echo $datos['TITULO']?></h5>
                      <div class="d-grid gap-2 d-md-block my-3">
                          <abbr title="<?php echo $datos['DESCRIPCION']?>"><button class="btn btn-warning btn-sm" disabled><?php echo $datos['CLASIFICACION']?></button></abbr>
                          <button class="btn btn-outline-secondary btn-sm" disabled><?php echo $datos['DURACION']?></button>
                          <button class="btn btn-outline-secondary btn-sm" disabled><?php echo $datos['GENERO']?></button>
                      </div>
                        <!--TARJETA-->
                        <div class="card my-2">
                          <div class="card-header fw-bold">
                            Multiplaza Tegucigalpa
                          </div>
                          <div class="card-body">
                            <p class="card-text fw-lighter text-muted small">*Los horarios aquĂ­ expuestos representan el inicio de cada funciĂ³n</p>
                        
                            <?php
                            // Si hay resultados para peliculas dobladas ejecuta esta sentencia
                            if($resulDOB >= 1){
                            ?>
                                <p class="fw-bold"><span class="badge bg-secondary">DOB</span>
                                    <?php foreach($dataHI as $HIDOB){?>
                                    <a href="boletos.php?id=<?php echo $HIDOB['ID_CARTELERA']?>" class="btn btn-danger btn-sm"><?php echo $HIDOB['HORA_INICIO']?></a>
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
                                    <a href="boletos.php?id=<?php echo $HISUB['ID_CARTELERA']?>" class="btn btn-danger btn-sm"><?php echo $HISUB['HORA_INICIO']?></a>
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
             <h6 class="border-bottom">PROGRAMACIĂ“N</h6>
            </div>
            <a style="text-decoration:none" href="cartelera.php" class="text-secondary">Cartelera</a> <br>
            <a style="text-decoration:none" href="peliculas.php" class="text-secondary">PrĂ³ximamente</a> <br>
            <a style="text-decoration:none" href="peliculas.php" class="text-secondary">Preventa</a>
          </div>
          <div class="col-md-2">
            <div class="text-start">
              <h6 class="border-bottom">SOBRE CINEMATRIX</h6>
            </div>
            <a style="text-decoration:none" href="quienes-somos.php" class="text-secondary">Â¿Quienes somos?</a> <br>
            <a style="text-decoration:none" href="terminos.php" class="text-secondary">TĂ©rminos y condiciones</a>
          </div>
          <div class="col-md-2">
            <div class="text-start">
              <h6 class="border-bottom">CONTĂ?CTENOS</h6>
            </div>
            <a style="text-decoration:none" href="https://github.com/MainFriends" class="text-secondary">EscrĂ­benos</a> <br>
            <a style="text-decoration:none" href="https://github.com/MainFriends/cinematrix" class="text-secondary">Trabaje con nosotros</a>
          </div>
        </div>
      </div>
    </footer>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
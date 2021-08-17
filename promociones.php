<?php
   setlocale(LC_TIME, 'Spanish'); // lenguaje español de fecha
   session_start();
   require_once 'inc/session.php';
   $_SESSION['pag'] = 'promociones';
   if(isset($_SESSION['usuario'])){
      $userSession = $_SESSION['usuario'];
      $userId = $_SESSION['id_usuario'];

      $query = "SELECT FOTO_PERFIL FROM USUARIO where ID_USUARIO = '$userId'";
      $stm = $conexion->prepare($query);
      $stm->execute();
      $foto = $stm->fetch(PDO::FETCH_ASSOC);
      $foto_perfil = $foto['FOTO_PERFIL'];
   }
   require_once "inc/functions.php";

   // Consulta promociones de taquilla
   $query = "SELECT * FROM promocion, programacion_promo 
   WHERE promocion.id_promo = programacion_promo.id_promo
   AND id_categoria = 2";
   $stm = $conexion->prepare($query);
   $stm->execute();
   $dataTaquilla = $stm->fetchAll(PDO::FETCH_ASSOC);

   // Consulta promociones de dulceria
   $query = "SELECT * FROM promocion, programacion_promo 
   WHERE promocion.id_promo = programacion_promo.id_promo
   AND id_categoria = 1";
   $stm = $conexion->prepare($query);
   $stm->execute();
   $dataDulceria = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promociones - Cinematrix</title>
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
  <div class="container-fluid bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a href="index.php"><img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="70" alt=""></a>
        <span class="me-2 fs-3 fw-bold mb-0"><a class="fw-bold text-dark" href="index.php">Cinematrix</a></span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

    <!--CUERPO-->
    <div class="card" style="background-color: #E3E4E5;">
      <div class="card-body">
        <h5 class="card-title">PROMOCIONES DISPONIBLES</h5>
        <h6 class="card-subtitle mb-2 text-muted small">TODAS LAS PROMOCIONES ESTÁN SUJETAS A TÉRMINOS Y CONDICIONES</h6>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="my-4 col-md-12">
          <!-- Nav tabs -->
          <ul  class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-danger active btn btn-outline-danger  me-1" id="pills-taquilla-tab" data-bs-toggle="pill"
                data-bs-target="#pills-taquilla" type="button" role="tab" aria-controls="pills-taquilla"
                aria-selected="true">Taquilla</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-danger btn btn-outline-danger" id="pills-dulce-tab" data-bs-toggle="pill" data-bs-target="#pills-dulce"
                type="button" role="tab" aria-controls="pills-dulce" aria-selected="false">Dulcería</button>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-taquilla" role="tabpanel"
              aria-labelledby="pills-taquilla-tab">
              <div class="row">
                <?php
                  foreach($dataTaquilla as $taquilla){
                  $dateStartConvert = utf8_encode(strftime('%d %b %Y', strtotime($taquilla['FECHA_INICIO'])));
                  $dateEndConvert = utf8_encode(strftime('%d %b %Y', strtotime($taquilla['FECHA_FIN'])));
                ?>
                <div class=" my-2 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <a href="detallePromo.php?id=<?php echo $taquilla['ID_PROMO'] ?>"> <img src="<?php echo $taquilla['IMAGEN']?>" class="rounded float-start" width="250px" height="175px" alt=""></a>
                        </div>
                        <div class="col-md-6">
                          <div class="card-title">
                            <h5><?php echo $taquilla['NOMBRE']?></h5>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Comienza: <?php echo ucwords($dateStartConvert)?></p>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Termina: <?php echo ucwords($dateEndConvert)?></p>
                            
                            <div class="d-grid gap-2 ">
                              <a class="btn btn-danger btn-block" href="detallePromo.php?id=<?php echo $taquilla['ID_PROMO'] ?>" >VER DETALLE</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                ?>
              </div>
            </div>
            <!--Panel dulcería-->
      <div class="tab-pane fade" id="pills-dulce" role="tabpanel" aria-labelledby="pills-dulce-tab">
      <div class="row">
      <?php
        foreach($dataDulceria as $dulceria){
        $dateStartConvertD = utf8_encode(strftime('%d %b %Y', strtotime($dulceria['FECHA_INICIO'])));
        $dateEndConvertD = utf8_encode(strftime('%d %b %Y', strtotime($dulceria['FECHA_FIN'])));
      ?>
        <div class=" my-2 col-md-6">
          <div class="card h-100">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <a href="detallePromo.php?id=<?php echo $dulceria['ID_PROMO'] ?>"> <img src="<?php echo $dulceria['IMAGEN']?>" class="rounded float-start" width="250px" height="175px" alt=""></a>
                </div>
                <div class="col-md-6">
                  <div class="card-title">
                    <h5><?php echo $dulceria['NOMBRE']?></h5>
                    <!--relojito-->
                    <p><i class="bi bi-clock"></i> Comienza: <?php echo ucwords($dateStartConvertD)?></p>
                    <!--relojito-->
                    <p><i class="bi bi-clock"></i> Termina: <?php echo ucwords($dateEndConvertD)?></p>
                    
                    <div class="d-grid gap-2 ">
                      <a class="btn btn-danger btn-block" href="detallePromo.php?id=<?php echo $dulceria['ID_PROMO'] ?>" >VER DETALLE</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
        }
      ?>
      </div>
      </div> 
      </div>
      </div>          
    </div>
  </div>

  <!--FINAL DEL CUERPO-->
  </div>
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
            <a style="text-decoration:none" href="cartelera.php" class="text-secondary">Cartelera</a> <br>
            <a style="text-decoration:none" href="peliculas.php" class="text-secondary">Próximamente</a> <br>
            <a style="text-decoration:none" href="peliculas.php" class="text-secondary">Preventa</a>
          </div>
          <div class="col-md-2">
            <div class="text-start">
              <h6 class="border-bottom">SOBRE CINEMATRIX</h6>
            </div>
            <a style="text-decoration:none" href="quienes-somos.php" class="text-secondary">¿Quienes somos?</a> <br>
            <a style="text-decoration:none" href="terminos.php" class="text-secondary">Términos y condiciones</a>
          </div>
          <div class="col-md-2">
            <div class="text-start">
              <h6 class="border-bottom">CONTÁCTENOS</h6>
            </div>
            <a style="text-decoration:none" href="https://github.com/MainFriends" class="text-secondary">Escríbenos</a> <br>
            <a style="text-decoration:none" href="https://github.com/MainFriends/cinematrix" class="text-secondary">Trabaje con nosotros</a>
          </div>
        </div>
      </div>
    </footer>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
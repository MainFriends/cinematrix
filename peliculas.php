<?php
   session_start();
   require_once 'inc/session.php';
   $_SESSION['pag'] = 'peliculas';
   if(isset($_SESSION['usuario'])){
      $userSession = $_SESSION['usuario'];
      $userId = $_SESSION['id_usuario'];

      $query = "SELECT FOTO_PERFIL FROM USUARIO where ID_USUARIO = '$userId'";
      $stm = $conexion->prepare($query);
      $stm->execute();
      $foto = $stm->fetch(PDO::FETCH_ASSOC);
      $foto_perfil = $foto['FOTO_PERFIL'];
   }

   // Consulta peliculas en cartelera
   $query = "SELECT * FROM PELICULA where id_estado = 8";
   $stm = $conexion->prepare($query);
   $stm->execute();
   $dataCartelera = $stm->fetchAll(PDO::FETCH_ASSOC);

   // Consulta peliculas en pre-venta
   $query = "SELECT * FROM PELICULA where id_estado = 6";
   $stm = $conexion->prepare($query);
   $stm->execute();
   $dataPreventa = $stm->fetchAll(PDO::FETCH_ASSOC);

   // Consulta peliculas en proximamente
   $query = "SELECT * FROM PELICULA where id_estado = 7";
   $stm = $conexion->prepare($query);
   $stm->execute();
   $dataProximamente = $stm->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas - Cinematrix</title>
    <link rel="shortcut icon" href="assets/img/logos/cinematrix_ico.png">
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
<div class = "container-fluid bg-ligth">
<!-- NAVBAR-->
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
                        <li><a class='dropdown-item' href='admin/graph/index.php'><i class='fas fa-tachometer-alt me-2'></i>Dashboard</a></li>
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

<!-- TITULO--> 
      <div class="card" style="background-color: #e9ecef;">
      <div class="card-body">
        <h5 class="card-title mb-0">PELICULAS</h5>
        <h7 class="card-subtitle mb-2 text-muted small">DONDE LA REALIDAD SUPERA LA FICCION.</h7>
      </div>
    </div>
    <div class="container">
     <div class="row">
        <div class="my-4 col-md-12">

<!-- PELICULAS ESTRENO-->
<div class="container w-60 px-4 ">
    <div class="row py-4" >
      <h4 class="fw-bold">Cartelera semanal</h4>
      <?php
         foreach($dataCartelera as $cartelera){
      ?>
      <div class="col-md-2 me-4">
         <div class="card" style="width: 12rem;">
            <a href="pelicula.php?id=<?php echo $cartelera['ID_PELICULA']?>"><img src="<?php echo $cartelera['PORTADA']?>" height="300" width="200" alt="..."></a> 
         </div>
      </div>
      <?php
      }
      ?>
    </div>
</div>

    <!-- PREVENTA-->
<div class="container w-60 px-4 ">
    <div class="row py-4" >
      <h4 class="fw-bold">Preventa</h4>

      <?php
         foreach($dataPreventa as $preventa){
      ?>
      <div class="col-md-2 me-4">
         <div class="card" style="width: 12rem;">
            <a href="#"><img src="<?php echo $preventa['PORTADA']?>" height="300" width="200" alt="..."></a> 
         </div>
      </div>
      <?php
      }
      ?> 
    </div>
</div>

    <!-- PROXIMAMENTE-->
    <div class="container w-60 px-4 ">
    <div class="row py-4" >
      <h4 class="fw-bold">Próximamente</h4>

      <?php
         foreach($dataProximamente as $proximamente){
      ?>
      <div class="col-md-2 me-4">
         <div class="card" style="width: 12rem;">
            <a href="#"><img src="<?php echo $proximamente['PORTADA']?>" height="300" width="200" alt="..."></a> 
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

<!-- FOOTER--> 
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
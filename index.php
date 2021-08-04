<?php
   session_start();
   require_once 'inc/session.php';
   $_SESSION['pag'] = 'index';
   if(isset($_SESSION['usuario'])){
      $userSession = $_SESSION['usuario'];
   }
   require_once "inc/functions.php";
   // Consulta peliculas
   $query = "SELECT * FROM PELICULA where id_estado = 8";
   $stm = $conexion->prepare($query);
   $stm->execute();
   $data = $stm->fetchAll(PDO::FETCH_ASSOC);

   $queryP = "SELECT * FROM PELICULA where id_estado = 6";
   $stm = $conexion->prepare($queryP);
   $stm->execute();
   $dataP = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Página principal - Cinematrix</title>
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/style-index.css">
   <link rel="stylesheet" href="assets/css/lightslider.css">
   <link rel="stylesheet" href="assets/css/multicarousel.css">
   <link rel="stylesheet" href="assets/css/hover.css">
</head>

<body>
   <div class="container-fluid bg-light">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
         <div class="container-fluid">
            <img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="70" alt="">
            <span class="me-2 fs-3 fw-bold mb-0">Cinematrix</span>
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
                     echo "<div class='nav-item dropdown'>
                     <a class='nav-link text-dark dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        $userSession $userApellido
                     </a>
                     <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>
                       <li><a class='dropdown-item' href='account.php'>Mi Perfil</a></li>
                       <li><a class='dropdown-item' href='inc/logout.php'>Cerrar sesión</a></li>
                     </ul>
                   </div>";
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
         
         <div class="row py-4">
            <div class="container w-60 px-4">
               <h4 class="fw-bold px-2">Cartelera Semanal</h4>
               <!--slider------------------->
               <ul id="autoWidth" class="cs-hidden">
                  <!--1------------------------------>
                  <?php 
                  foreach($data as $peli){   
                  ?>
                  <li class="item-a">
                     <!--slider-box-->
                     <div class="box">
                        <!--model-->
                        <!--Inicio del Hover-->
                        <div class="contenedor">
                        <figure>
                        <a href="pelicula.php?id=<?php echo $peli['ID_PELICULA']?>"><img class="rounded" src="<?php echo $peli['PORTADA']?>" width="200" height="250"
                           class="model">
                           <div class="capa">
                              <h3><?php echo $peli['TITULO']?></h3>
                              <p><?php echo $peli['AÑO']?></p> 
                              </a>  
                           </div> 
                     </figure>
                    </div>
                     </div>
                  </li> 
               <?php
               }
               ?>             
               </ul>
            </div>
         </div>

         

         <!-- CARROUSEL PREVENTA -->
         <div class="row py-3">
            <div class="container w-60 px-4">
               <h4 class="fw-bold px-2">Preventa / Próximos Estrenos</h4>
               <!--slider------------------->
               <ul id="autoWidth2" class="cs-hidden2">
                  <!--1------------------------------>
                  <?php 
                  foreach($dataP as $peliP){   
                  ?>
                  <li class="item-a">
                     <!--slider-box-->
                     <div class="box">
                        <!--model-->
                        <!--Inicio del Hover-->
                        <div class="contenedor">
                        <figure>
                        <a href="pelicula.php?id=<?php echo $peliP['ID_PELICULA']?>"><img class="rounded" src="<?php echo $peliP['PORTADA']?>" width="200" height="250"
                           class="model">
                           <div class="capa">
                              <h3><?php echo $peliP['TITULO']?></h3>
                              <p><?php echo $peliP['AÑO']?></p> 
                              </a>  
                           </div> 
                     </figure>
                    </div>
                     </div>
                  </li> 
               <?php
               }
               ?>      
               </ul>
            </div>
         </div>

         <h4 class="fw-bold ms-3">Promociones</h4>
         <section id="slider">
            <input type="radio" name="slider" id="s1">
             <input type="radio" name="slider" id="s2">
              <input type="radio" name="slider" id="s3" checked>
               <input type="radio" name="slider" id="s4">
                <input type="radio" name="slider" id="s5">

                <!--Promoción 1----->
                <label for="s1" id="slide1">
                   <img src="assets/img/sliders/Portada-Promoción1.jpeg" width="100%" height="100%">
                </label>

                <!--Promoción 2----->
                <label for="s2" id="slide2">
                  <img src="assets/img/sliders/Portada-Promoción2.jpeg" width="100%" height="100%">
               </label>

               <!--Promoción 3----->
               <label for="s3" id="slide3">
                  <img src="assets/img/sliders/Portada-Promoción3.jpeg" width="100%" height="100%">
               </label>

               <!--Promoción 4----->
               <label for="s4" id="slide4">
                  <img src="assets/img/sliders/Portada-Promoción4.jpeg" width="100%" height="100%">
               </label>

               <!--Promoción 5----->
               <label for="s5" id="slide5">
                  <img src="assets/img/sliders/Portada-Promoción5.jpg" width="100%" height="100%">
               </label>
         </section>
      </div>

          
   <footer>
      <div class="container-fluid">
         <div class="row bg-light">
            <div class="col-md-4 my-3">
               <div class="text-center">
                  <img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="175" alt="">
               </div>
            </div>
            <div class="col-md-2 my-3">
               <div class="text-start">
                  <h6 class="border-bottom">PROGRAMACIÓN</h6>
               </div>
               <a style="text-decoration:none" href="#" class="text-secondary">Cartelera</a> <br>
               <a style="text-decoration:none" href="#" class="text-secondary">Próximamente</a> <br>
               <a style="text-decoration:none" href="#" class="text-secondary">Preventa</a>
            </div>
            <div class="col-md-2 my-3">
               <div class="text-start">
                  <h6 class="border-bottom">SOBRE CINEMATRIX</h6>
               </div>
               <a style="text-decoration:none" href="#" class="text-secondary">¿Quienes somos?</a> <br>
               <a style="text-decoration:none" href="#" class="text-secondary">Términos y condiciones</a>
            </div>
            <div class="col-md-2 my-3">
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
   <script src="assets/js/lightslider.js"></script>
   <script src="assets/js/index.js"></script>
   <script src="assets/js/multicarousel.js"></script>
</body>

</html>
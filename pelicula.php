<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
<div class = "container-fluid bg-ligth">
<!-- NAVBAR-->
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
                     <a class="nav-link" aria-current="page" href="#">PELÍCULAS</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">CARTELERA</a>
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

<!-- TITULO--> 
      <div class="card" style="background-color: #e9ecef;">
      <div class="card-body">
        <h5 class="card-title">PELICULAS</h5>
        <h7 class="card-subtitle mb-2 text-muted">DONDE LA REALIDAD SUPERA LA FICCION</h7>
      </div>
    </div>
    <div class="container">
     <div class="row">
        <div class="my-4 col-md-12">

<!-- PELICULAS ESTRENO-->
<div class="container w-60 px-4 ">
    <div class="row py-4" >
      <h4 class="fw-bold">Cartelera Semanal</h4>

      <div class="col-md-2">
      <div class="card" style="width: 13rem;">
      <img src="assets/img/sliders/Portada-Venom2.jpeg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="assets/img/sliders/Portada-Thor4.jpeg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="assets/img/sliders/Portada-Spiderman.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="assets/img/sliders/Portada-Conjuro.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="assets/img/sliders/Portada-DurodeCuidar.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 mt-3">
      <div class="card" style="width: 13rem;">
      <img src="assets/img/sliders/Portada-DoctorStrange.jpeg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3 mt-3">
      <div class="card" style="width: 13rem;">
      <img src="assets/img/sliders/Portada-EscuadronSuicida.jpeg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

    </div>
    </div>

    <!-- PREVENTA-->
<div class="container w-60 px-4 ">
    <div class="row py-4" >
      <h4 class="fw-bold">Preventa</h4>

      <div class="col-md-2">
      <div class="card" style="width: 13rem;">
      <img src="https://lumiere-a.akamaihd.net/v1/images/image_2ff75a5c.jpeg?region=0%2C0%2C540%2C810" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="https://es.web.img3.acsta.net/pictures/21/04/21/11/08/5393301.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="http://gnula.nu/wp-content/uploads/2021/07/Prime_Time_poster_polonia.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="https://cloudfront-us-east-1.images.arcpublishing.com/copesa/DKXOA5MXJ5DXZF46R5PVRYF6WM.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="https://lumiere-a.akamaihd.net/v1/images/image_517212da.jpeg?region=0%2C0%2C540%2C810" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 mt-3">
      <div class="card" style="width: 13rem;">
      <img src="https://lumiere-a.akamaihd.net/v1/images/p_rayaandthelastdragon_es_06f8daf0.jpeg?region=0%2C0%2C540%2C810" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3 mt-3">
      <div class="card" style="width: 13rem;">
      <img src="https://es.web.img3.acsta.net/pictures/21/05/19/18/24/3325682.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>
        
    </div>
    </div>

    <!-- PROXIMAMENTE-->
    <div class="container w-60 px-4 ">
    <div class="row py-4" >
      <h4 class="fw-bold">Proximamente</h4>

      <div class="col-md-2">
      <div class="card" style="width: 13rem;">
      <img src="https://somoskudasai.com/wp-content/uploads/2020/11/EoD3BdSXcAA_Kfy.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="https://i1.wp.com/elpalomitron.com/wp-content/uploads/2020/05/Tr%C3%A1iler-de-la-cuarta-temporada-de-Shingeki-no-Kyojin-cartel-El-Palomitr%C3%B3n.jpg?resize=500%2C700&ssl=1" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="https://static.wikia.nocookie.net/2164aac6-9297-4ab3-9f67-8f941ae4945a" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="https://pm1.narvii.com/6357/981609f7658674afb8da30dc16b2e8e6d5f482ec_hq.jpg" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>

      <div class="col-md-2 ms-3">
      <div class="card" style="width: 13rem;">
      <img src="https://static.wikia.nocookie.net/doblaje/images/5/5e/Fullmetal-Alchemist-Poster.jpg/revision/latest?cb=20171106014624&path-prefix=es" class="card-img-top" height="300" alt="..."> 
        </div>
        </div>
        
    </div>
    </div>

 <!-- FOOTER--> 
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
</div>


<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
   session_start();
   require_once 'inc/session.php';
   $_SESSION['pag'] = 'detallePromo';
   if(isset($_SESSION['usuario'])){
      $userSession = $_SESSION['usuario'];
   }
   require_once "inc/functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle promoción - Cinematrix</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="70" alt="">
        <span class="me-2 fs-3 fw-bold mb-0">Cinematrix</span>
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
      </div>
    </nav>

    <!--CUERPO-->
    <div class="card" style="background-color: #E3E4E5;">
      <div class="card-body">
        <h5 class="card-title">PROMOCIONES DISPONIBLES</h5>
        <div class="row">
          <div class="col-md-8">
            <h6 class="card-subtitle mb-2 text-muted">TODAS LAS PROMOCIONES ESTÁN SUJETAS A TÉRMINOS Y CONDICIONES</h6>
          </div>
            <div class="col-md-4">
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="promociones.html"><button class="btn btn-outline-danger me-md-2 btn-sm" type="button">Volver a las promociones</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    <div class="container">
      <div class="row">
        <div class="my-4 col-md-8">
          <h2>DESCUENTO TERCERA EDAD</h2>
        </div>
        
      </div>
      <div class="row">
        <div class="my-0 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <img src="assets/img/promociones/terceraEdad.jpg" class="rounded float-start" width="100%"
                    height="100%" alt="">
                </div>
                <div class="col-md-6">
                  <div class="card-title">
                    <p>
                    <h3>Descripción de la promoción</h3>
                    </p><br>
                    <p>DISFRUTA DE PRECIO ESPECIAL PARA PERSONAS MAYORES DE 60 AÑOS, AL MOSTRAR UN DOCUMENTO DE
                      IDENTIDAD VIGENTE.</p>
                    <!--relojito-->
                    <p><i class="bi bi-clock"></i> Comienza: </p>
                    <!--relojito-->
                    <p><i class="bi bi-clock"></i> Termina: </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="my-4 col-md-12">
          <div class="card">
            <div class="card-body">
              <h5>CONDICIONES DE LA PROMOCIÓN</h5>
              <p><i class="bi bi-chevron-right"></i> Tarjeta</p>

            </div>
          </div>
        </div>
      </div>
    </div>



  </div>






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
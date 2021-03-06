<?php
   session_start();
   require_once 'inc/session.php';
   $_SESSION['pag'] = 'terminos';
   if(isset($_SESSION['usuario'])){
      $userSession = $_SESSION['usuario'];
      $userId = $_SESSION['id_usuario'];

      $query = "SELECT FOTO_PERFIL FROM USUARIO where ID_USUARIO = '$userId'";
      $stm = $conexion->prepare($query);
      $stm->execute();
      $foto = $stm->fetch(PDO::FETCH_ASSOC);
      $foto_perfil = $foto['FOTO_PERFIL'];
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Página principal - Cinematrix</title>
   <link rel="shortcut icon" href="assets/img/logos/cinematrix_ico.png">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/style-index.css">
   <link rel="stylesheet" href="assets/css/lightslider.css">
   <link rel="stylesheet" href="assets/css/multicarousel.css">
   <link rel="stylesheet" href="assets/css/hover.css">

   <!-- FONT -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

   <!-- ICONOS -->
   <script src="https://kit.fontawesome.com/151b334714.js" crossorigin="anonymous"></script>
</head>

<body>
   <div class="container-fluid bg-light">
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

          <div class="container">
            <div class="text-center my-4">
              <img src="assets/img/logos/legal.svg" class="rounded" width="50" alt="...">
              <p class="text-danger text-center"><strong>TÉRMINOS Y CONDICIONES DE USO DEL SITIO WEB</strong></p>
            </div>
            <div class="container">
              <div class="row d-flex justify-content-center">
                <div class="my-4 col-md-8">
                  <p class="lh-lg text-secondary">
                    El presente documento regula los Términos y Condiciones, del sitio web (Cinematrix), en cuales un usuario, consumidor, comprador, cliente o usted, 
                    en adelante el “Usuario”, tiene derecho a ingresar y usar el Sitio Web para comprar entradas de cine, o cualquier otro producto disponible en el mismo, contratar cualquier servicio 
                    disponible en el mismo, y/o acceder a información, texto, u otro material comunicado en el Sitio Web. En el Sitio Web podrá navegar,
                    visitar, comparar y, si lo desea, adquirir los bienes o servicios que ahí se exhiben.
                  </p>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          <strong>1. ACEPTACIÓN DE TÉRMINOS Y CONDICIONES DE USO</strong>
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body "><p class="lh-lg text-secondary">Por favor lea la siguiente información detalladamente antes de usar el Sitio Web. Usted deberá hacer clic donde el Sitio Web ofrezca esta opción en la interfaz del Usuario con la frase 
                          “Acepto los Términos y Condiciones” u otra equivalente que permita dar su consentimiento inequívoco respecto de la aceptación. Al hacer clic a “Acepto los Términos y Condiciones”, Usted está aceptando que ha leído 
                          y entendido estos Términos y Condiciones, y queda sujeto a ellos. Cinematrix se reserva el derecho, bajo su propio criterio, de modificar, alterar, o de otro modo actualizar estos Términos y Condiciones en cualquier momento.
                          Por lo anterior, se sugiere que revise estos Términos y Condiciones cada vez que haga uso del Sitio Web.</p></div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                          <strong>2. USO DE SITIO WEB</strong>
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p class="lh-lg text-secondary">A través del Sitio Web, el Usuario podrá acceder a los contenidos, productos y servicios allí ofrecidos. El Usuario deberá utilizar el Sitio Web de conformidad con la moral 
                          y las buenas costumbres, así como de acuerdo a lo estipulado en estos Términos y Condiciones.<br><b>2.1	Registro</b><br>
                          El registro en el Sitio Web y el uso de contraseña no es requisito obligatorio para usar y entrar al Sitio Web, sin embargo, facilita el acceso personalizado, confidencial y seguro al Sitio Web.
                          En caso de registrarse en el Sitio Web, el Usuario contará con una contraseña, de la cual podrá disponer, e incluso modificar, si así lo requiriera el Usuario. Para crear una cuenta deberá ingresar a la opción de registro en el Sitio Web y completar el formulario de registro.
                          <br>El Usuario es responsable de mantener la confidencialidad de su contraseña y su cuenta. El Usuario acuerda que será completamente responsable por toda actividad que se realice bajo su contraseña y cuenta.  </p></div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                          <strong>3. POLÍTICA DE COMPRAS A TRAVÉS DEL SITIO WEB</strong>
                        </button>
                      </h2>
                      <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p class="lh-lg text-secondary"><b>El servicio de cineticket de Cinematrix ofrece:</b><br> Los boletos únicamente pueden ser comprados usando tu cuenta de paypal.<br>
                          Los boletos comprados a través de este sitio no son reembolsables por dinero, 
                          a menos que se sea legalmente requerido. Los boletos comprados son válidos 
                          únicamente en el cine para el cual se adquirieron y no pueden ser cambiados 
                          para otro cine.<br><b>Al comprar boletos a través de este sitio aceptas que:</b><br>
                          Debes de respetar el asiento reservado a través de tu compra.<br>Las entradas adquiridas durante el proceso de compra en línea, únicamente podrán ser recolectadas por el Usuario con la identificación y tarjeta correspondiente.
                          Podrá retirar las entradas en la taquilla del cine, desde el mismo día que se realiza la compra y hasta la hora que inicie la función adquirida. En caso de no presentarse a la función, no hay cambios ni reembolsos.</p></div>
                      </div>
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
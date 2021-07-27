<?php
   session_start();
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
  <title>Vista general de la cuenta - Cinematrix</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- CSS de la pagina-->
  <link rel="stylesheet" href="assets/css/style-account.css">
  <!-- Iconos -->
  <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
  <!-- Fuente -->
  <link href = "https: //fonts.googleapis.com/css2? family = Poppins: wght @ 100 & display = swap "rel =" stylesheet ">
  <script src="https://kit.fontawesome.com/151b334714.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-fluid bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <div class="container-fluid">
        <img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="70" >
        <span class="me-2 fs-3 fw-bold mb-0">Cinematrix</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <form class="px-4 py-1" action="#">
                           <label class="label-control" for="">Correo electrónico</label>
                           <input class="form-control" type="text">
                           <label class="label-control" for="">Contraseña</label>
                           <input class="form-control" type="password">
                           <div class="py-2">
                              <input type="checkbox" name="connected" class="form-check-input">
                              <label for="connected" class="form-check-label">Mantenerme conectado</label>
                           </div>
                           <div class="py-2 d-grid">
                              <button type="button" class=" d-grid btn btn-primary">Iniciar sesión</button>
                           </div>
                        </form>
                     </ul>
                  </div>';
                  }
               ?>
        </div>
      </div>
    </nav>

    <!-- CUERPO -->
    <div class="container shadow my-4">
      <div class="row bg">
        <div class="col-4 bg-dark bou rounded-start">
          <div class="text-center my-3">
            <img
              src="https://scontent.ftgu3-1.fna.fbcdn.net/v/t1.6435-9/126927505_3336886819757413_731241350087965538_n.jpg?_nc_cat=102&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=5-mg3O8KBTYAX_M7HmA&_nc_ht=scontent.ftgu3-1.fna&oh=6f9cd094ac640db775f2f9007e0d913b&oe=60FD1E94"
              width="180" class="rounded-circle" alt="...">
          </div>
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active bg-dark text-light my-2" id="list-home-list"
              data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home"><i
                class="far fa-eye ">  </i>  Vista general de la cuenta</a>
            <a class="list-group-item list-group-item-action bg-dark text-light" id="list-profile-list"
              data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile"
              ><i class="fas fa-user-edit"></i>   Editar perfil</a>
            <a class="list-group-item list-group-item-action bg-dark text-light" id="list-contraseña-list"
              data-bs-toggle="list" href="#list-contraseña" role="tab" aria-controls="list-contraseña"><i
                class="fas fa-user-lock"></i> Cambiar contraseña</a>
            <a class="list-group-item list-group-item-action bg-dark text-light" id="list-settings-list"
              data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings"><i
                class="fas fa-bell"></i> Notificaciones</a>
          </div>
        </div>
        <div class="col-8 rounded-end">
          <div class="my-5 mx-3">

            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                <h1 class="fw-bold my-3 md-2">PERFIL DE USUARIO</h1>
                <h2 class="fw-bold my-5"></h2>
                <div class="row border-bottom">
                  <div class="col-md-6 my-2">
                    <p>Nombre de usuario</p>
                  </div>
                  <div class="col-md-6 my-2">
                    <p class="fw-bold" >Josue Maradiaga</p>
                  </div>
                </div>
                <div class="row border-bottom ">
                  <div class="col-md-6 my-2 ">
                      <p>Email </p>
                  </div>
                  <div class="col-md-6 my-2">
                    <p class="fw-bold">josue@hotmail.com</p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-md-6 my-2">
                    <p>Fecha de nacimiento</p>
                  </div>
                  <div class="col-md-6 my-2 }">
                    <p class="fw-bold">12 de febrero de 1998</p>
                  </div>  
                </div>
                <div class="row border-bottom">
                  <div class="col-md-6 my-2">
                    <p>Pais</p>
                  </div>
                  <div class="col-md-6 my-2">
                    <p class="fw-bold"> Honduras</p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-md-6 my-2">
                    <p >Ciudad</p>
                  </div>
                  <div class="col-md-6 my-2">
                    <p class="fw-bold">Tegucigalpa</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                <form>
                  <h1 class="fw-bold my-5">DESCRIPCION DE TU CUENTA</h1>
                  <div class="my-3 mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Nombre</label>
                    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="my-3 mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Correo electrónico</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="my-3 mb-3">
                    <label class="fw-bold" for="datetime ">Fecha de nacimiento</label>
                    <input type="date" class=" form-control my-3">
                  </div>
                  <class class="my-3 mb-3 fw-bold">Cambiar foto de perfil
                    <input type="file" class="form-control my-2">
                </class>
                  
                  
                  <div class="my-3 mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Ciudad</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="my-3 mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Pais</label>
                    <input type="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Estoy de acuerdo con las politicas de registro
                      que
                      corresponden al servicio de Cinematrix</label>
                   </div>
                  <button type="submit" class="btn btn-ligth btn btn-outline-primary">Guardar perfil</button>
                </form>
              </div>

                 <div class="tab-pane fade" id="list-contraseña" role="tabpanel" aria-labelledby="list-contraseña-list">
                    <!--CUERPO DE CONTRASE;A-->
                    <h1 class="fw-bold my-2">CAMBIA TU CONTRASEÑA</h1>
                    <form>
                      <div class="form-group fw-bold my-4" >
                        <label for="formGroupExampleInput">Contraseña actual</label>
                        <input type="text" class="form-control  p-2 mb-2 bg-body rounded" id="formGroupExampleInput" placeholder=>
                      </div>
                      <div class="my-4  form-group fw-bold ">
                        <label for="formGroupExampleInput2">Nueva contraseña</label>
                        <input type="text" class="form-control p-2 mb-2 bg-body rounded" id="formGroupExampleInput2" placeholder=>
                      </div>
                      <div class="form-group fw-bold">
                        <label for="formGroupExampleInput">Confirmar nueva contraseña</label>
                        <input type="text" class="form-control p-2 mb-2 bg-body rounded" id="formGroupExampleInput" placeholder=>
                      </div> 
                      <div class=" mx-auto my-4">
                        <button type="button" class="btn btn-outline-primary">Establecer nueva contraseña</button>
                         <button type="button" class="btn btn-outline-primary">Cancelar</button>
                      </div>
                    </form>
                  </div>
                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                  <!--CUERPO DE NOTIFICACIONES-->
                  <h2 class="fw-bold my-4">CONFIGURACION DE NOTIFICACIONES</h2>
                  <h4 class="bg-danger badge text-wrap fs-5 progress-bar">Nuevas peliculas <span class="badge badge-secondary"></span></h4>
                  <p class="font-weight-light">Proximamente Spider-man no way home, estará llegando a nuestras pantallas.</p>
                  <p class="font-weight-light">Se aproxima El titanic a la pantalla grande.</p>
                  <p class="font-weight-light">Se viene la accion con Rapidos y furiosos 9.</p>
                  <h4 class="bg-danger badge text-wrap fs-5 progress-bar" >Las mejores promociones<span class="badge badge-secondary"></span></h4>
                  <p class="font-weight-light">Todos los martes estarán las entradas al 2x1.</p>
                  <p class="font-weight-light">Descuento del 20% todos los dias para la tercera edad.</p>
                  <p class="font-weight-light">Los viernes, los estudiantes con carné entran al 2x1.</p>
                </div>
              </div>
            </div>
          </div>
        </div>



    <!-- FIN CUERPO -->

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
</body>

</html>
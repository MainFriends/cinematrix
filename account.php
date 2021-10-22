<?php
   setlocale(LC_TIME, 'Spanish');  
   session_start();
   if(isset($_SESSION['usuario'])){
      $userSession = $_SESSION['usuario'];
      $userApellido = $_SESSION['apellido'];
      $userCorreo = $_SESSION['correo'];
      $userCiudad = $_SESSION['ciudad'];
      $userPais = $_SESSION['pais'];
      $userDate = $_SESSION['date'];
      $userId = $_SESSION['id_usuario'];
   }
   require_once "inc/functions.php";
   require_once 'inc/editarPerfil.php';
   $query = "SELECT FOTO_PERFIL FROM USUARIO where ID_USUARIO = '$userId'";
   $stm = $conexion->prepare($query);
   $stm->execute();
   $foto = $stm->fetch(PDO::FETCH_ASSOC);

   $query = "SELECT ID_FACTURA 
   FROM FACTURA
   WHERE ID_USUARIO = '$userId'
   AND ID_FACTURA > 16
   ORDER BY FECHA DESC";
   $stm = $conexion->prepare($query);
   $stm->execute();
   $facturas = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Perfil - Cinematrix</title>
  <link rel="shortcut icon" href="assets/img/logos/cinematrix_ico.png">
  <!-- CSS de la pagina-->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style-account.css">
  <!-- Iconos -->
  <script src="https://kit.fontawesome.com/151b334714.js" crossorigin="anonymous"></script>
  <!-- Fuente -->

  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <style type="text/css">
    a{
	    text-decoration:none;
    }
  </style>
</head>

<body>
  <div class="container-fluid bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
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
                        <li><a class='dropdown-item' href='admin/graph/index.php'><i class='fas fa-tachometer-alt me-2'></i>Dashboard</a></li>
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
            <?php 
              echo '<img width="180" height="180px" class="rounded-circle" alt="..." src="data:image/jpeg;base64,'.base64_encode($foto['FOTO_PERFIL']) .' "/>';?>
          </div>
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active bg-dark text-light my-2" id="list-home-list"
              data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home"><i
                class="far fa-eye me-2"></i>Vista general de la cuenta</a>
            <a class="list-group-item list-group-item-action bg-dark text-light" id="list-profile-list"
              data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile"
              ><i class="fas fa-user-edit btnEditarP me-2"></i>Editar perfil</a>
            <a class="list-group-item list-group-item-action bg-dark text-light" id="list-contraseña-list"
              data-bs-toggle="list" href="#list-contraseña" role="tab" aria-controls="list-contraseña"><i
                class="fas fa-user-lock me-2"></i>Cambiar contraseña</a>
            <a class="list-group-item list-group-item-action bg-dark text-light" id="list-settings-list"
              data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings"><i
                class="fas fa-ticket-alt me-2"></i>Tus tickets</a>
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
                    <p class="fw-lighter">Nombre de usuario</p>
                  </div>
                  <div class="col-md-6 my-2">
                    <p class="fw-bold" ><?php echo "$userSession $userApellido" ?></p>
                  </div>
                </div>
                <div class="row border-bottom ">
                  <div class="col-md-6 my-2 ">
                      <p class="fw-lighter">Email</p>
                  </div>
                  <div class="col-md-6 my-2">
                    <p class="fw-bold"><?php echo "$userCorreo" ?></p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-md-6 my-2">
                    <p class="fw-lighter">Fecha de nacimiento</p>
                  </div>
                  <div class="col-md-6 my-2 }">
                    <p class="fw-bold"><?php echo $userDate ?></p>
                  </div>  
                </div>
                <div class="row border-bottom">
                  <div class="col-md-6 my-2">
                    <p class="fw-lighter">Pais</p>
                  </div>
                  <div class="col-md-6 my-2">
                    <p class="fw-bold"><?php echo $userPais ?></p>
                  </div>
                </div>
                <div class="row border-bottom">
                  <div class="col-md-6 my-2">
                    <p class="fw-lighter">Ciudad</p>
                  </div>
                  <div class="col-md-6 my-2">
                    <p class="fw-bold"><?php echo $userCiudad ?></p>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                <form method="POST" enctype="multipart/form-data">
                  <h1 class="fw-bold my-5">DESCRIPCION DE LA CUENTA</h1>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="">
                        <label for="exampleInputEmail1" class="form-label fw-bold">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $userSession ?>" aria-describedby="emailHelp">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="">
                        <label for="exampleInputEmail1" class="form-label fw-bold">Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $userApellido ?>" aria-describedby="emailHelp">
                      </div>
                    </div>
                  </div>
                  <div class="my-3 mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Correo electrónico</label>
                    <input type="email" name="correo" class="form-control" value="<?php echo $userCorreo?>" aria-describedby="emailHelp">
                  </div>
                  <div class="my-3 mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Ciudad</label>
                    <input type="text" name="ciudad" value="<?php echo $userCiudad?>" class="form-control" aria-describedby="emailHelp">
                  </div>
                  <div class="my-3 mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Pais</label>
                    <select name="pais" id="inputCountry" class="form-select" required>
                    <option value="102">Honduras</option>
                    <?php
                        // Llenar la lista de opciones con paises de la DB
                        registroPais();
                    ?>
                    </select>
                  </div>
                  <div class="col-md-6 my-3 mb-3">
                    <label class="form-label fw-bold">Cambiar foto de perfil</label>
                    <input type="file" name="foto" class="form-control">
                  </div>
                  <div class="text-start">
                  <button type="submit" name="editar" class="btn btn-primary">Guardar perfil</button>
                  </div>
                  
                </form>
              </div>

                 <div class="tab-pane fade" id="list-contraseña" role="tabpanel" aria-labelledby="list-contraseña-list">
                    <!--CUERPO DE CONTRASE;A-->
                    <h1 class="fw-bold my-2">CAMBIA TU CONTRASEÑA</h1>
                    <form method="POST">
                      <div class="form-group fw-bold my-4" >
                        <label for="formGroupExampleInput">Contraseña actual</label>
                        <input type="password" name="pass" class="form-control p-2 mb-2 bg-body rounded" id="formGroupExampleInput">
                      </div>
                      <div class="my-4  form-group fw-bold ">
                        <label for="formGroupExampleInput2">Nueva contraseña</label>
                        <input type="password" id="pass1" class="form-control p-2 mb-2 bg-body rounded">
                      </div>
                      <div class="form-group fw-bold">
                        <label for="formGroupExampleInput">Confirmar nueva contraseña</label>
                        <input type="password" id="pass2" name="newPass" class="form-control p-2 mb-2 bg-body rounded">
                      </div>
                      <div id="msg"></div>
                      <div class=" mx-auto my-4">
                        <button type="submit" id="newPass" name="changePass" class="btn btn-primary">Establecer nueva contraseña</button>
                        <a href="account.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </form>
                  </div>
                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                  <!--CUERPO DE NOTIFICACIONES-->
                  <h2 class="fw-bold my-4">TICKETS</h2>
                  <?php foreach($facturas as $factura){
                    $id_factura = $factura['ID_FACTURA'];
                    $query = "SELECT DISTINCT TITULO, DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO, FECHA
                    FROM PELICULA, CARTELERA, DETALLE
                    WHERE PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
                    AND DETALLE.ID_CARTELERA = CARTELERA.ID_CARTELERA
                    AND ID_FACTURA = '$id_factura'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $detalle = $stm->fetch(PDO::FETCH_ASSOC);
                    $fechaES = utf8_encode(strftime('%A %d %B %Y', strtotime($detalle['FECHA'])));
                  ?>
                  <div class="row border-bottom mb-2">
                    <div class="col-md-3">
                      <h5 class="fw-bold">Pelicula</h5>
                      <p class="text-muted small"><?php echo $detalle['TITULO']?></p>
                    </div>
                    <div class="col-md-3">
                      <h5 class="fw-bold">Funcion</h5>
                      <p class="text-muted small"><?php echo $detalle['HORA_INICIO']?></p>
                    </div>
                    <div class="col-md-3">
                      <h5 class="fw-bold">Fecha</h5>
                      <p class="text-muted small"><?php echo ucwords($fechaES)?></p>
                    </div>
                    <div class="col-md-3">
                      <a href="reportes/reporte_tickets.php?idFactura=<?php echo $id_factura?>" target="_blank" class="btn btn-danger rounded mt-2">Imprimir ticket</a>
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



    <!-- FIN CUERPO -->

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
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/validarPass.js"></script>
</body>
</html>
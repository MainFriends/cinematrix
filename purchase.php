<?php
        setlocale(LC_TIME, 'Spanish');      
        session_start();
        require_once 'inc/session.php';
        $_SESSION['pag'] = 'pelicula';
        if(isset($_SESSION['usuario'])){
            $userSession = $_SESSION['usuario'];
            $userId = $_SESSION['id_usuario'];
            $userEmail = $_SESSION['correo'];

            $query = "SELECT FOTO_PERFIL FROM USUARIO where ID_USUARIO = '$userId'";
            $stm = $conexion->prepare($query);
            $stm->execute();
            $foto = $stm->fetch(PDO::FETCH_ASSOC);
            $foto_perfil = $foto['FOTO_PERFIL'];
        }

        //Obtenemos el id de la cartelera
        $id = $_GET['id'];

        //Obtenemos los asientos del usuario
        $userAsientos = $_SESSION['butacas'];

        //Obtenemos los combos del usuario
        $combo1 = $_SESSION['COMBO1'];
        $combo2 = $_SESSION['COMBO2'];
        $combo3 = $_SESSION['COMBO3'];
        $combo4 = $_SESSION['COMBO4'];
        $combo5 = $_SESSION['COMBO5'];
        $combo6 = $_SESSION['COMBO6'];
        $combo7 = $_SESSION['COMBO7'];

        //VARIABLE GLOBAL TOTAL
        $subtotal = 0;
        $descuento = 0;
        $cargoServicios = 25;
        $totalCompra = 0;
        $conversion = 0.042;

        //CONSULTA CARTELERA
        $query = "SELECT CARTELERA.ID_PELICULA, PORTADA, FORMATO, TITULO, FECHA, DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO
        FROM PELICULA, CARTELERA, FORMATO
        WHERE PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
        AND CARTELERA.ID_FORMATO = FORMATO.ID_FORMATO
        AND ID_CARTELERA = '$id'";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);

        $fechaES = utf8_encode(strftime('%A %d %B %Y', strtotime($data['FECHA'])));

        //CONSULTA ASIENTOS
        $query = "SELECT * FROM ASIENTO";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $asientos = $stm->fetchAll(PDO::FETCH_ASSOC);

        //CONSULTA SNACKS
        $query = "SELECT * FROM COMBO";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $snacks = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación y pago - Cinematrix</title>
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

  <script src="https://www.paypal.com/sdk/js?client-id=AcUdCT0r-0OmYDGQDWJz7XwKD2Iy1wx0epe63gyy8KX7QvUOZ_vWspeWkyqWfyHpoxXl7uboePUiqxJO"></script>
</head>

<body>
  <div class="container-fluid"> <!-- CONTAINER PRINCIPAL -->
    <!-- NAV -->
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
      <!-- FIN NAV -->

      <!-- Cuerpo-->
      <div class="container px-0">
        <div class="row my-4">
          <!-- Columna descripción pelicula-->
          <div class="col-md-3">
            <div class="row">
                <img src="<?php echo $data['PORTADA'] ?>" alt="">
            </div>
            <div class="row mt-3">
                <h5 class="border-bottom text-danger">TITULO ORIGINAL</h5>
                <p class="text-muted"><?php echo $data['TITULO'] ?></p>
            </div>
            <div class="row">
                <h5 class="border-bottom text-danger">FORMATO</h5>
                <abbr title=""><button class="btn btn-warning btn-sm fw-bold" disabled><?php echo $data['FORMATO'] ?></button></abbr>
            </div>
            <div class="row mt-3">
                <h5 class="border-bottom text-danger">FECHA Y HORARIO</h5>
                <p class="small text-muted"><?php echo strtoupper($fechaES) ." " .$data['HORA_INICIO'] ?></p>   
            </div>
            <div class="row">
                <h5 class="border-bottom text-danger">ENTRADAS</h5>
                <?php
                if($_SESSION['cantADULTREGULAR']>0){
                    $cantidad = $_SESSION['cantADULTREGULAR'];
                    echo "<p class='small text-muted mb-0'>$cantidad ADULTREGULAR-HO</p>";
                }
                if($_SESSION['cantCINEPACKPAREJA2D']>0){
                    $cantidad = $_SESSION['cantCINEPACKPAREJA2D']/2;
                    echo "<p class='small text-muted'>$cantidad CINEPACKPAREJA2D-HN</p>";
                }
                ?>
            </div>
            <div class="row mt-2">
                <h5 class="border-bottom text-danger">BUTACAS</h5>
                <?php
                foreach($userAsientos as $asientosUser){
                    foreach($asientos as $butacas){
                        if($asientosUser == $butacas['ID_ASIENTO']){
                            $nombre = $butacas['NUM_ASIENTO'];
                            echo "
                            <div class='col-md-1'>
                                <span class='text-muted small'>$nombre</span>
                            </div>";
                        }
                    }
                }
                ?>
            </div>
            <div class="row mt-2">
                <h5 class="border-bottom text-danger">SNACKS</h5>
                <?php
                foreach($snacks as $combo){
                    if($combo1[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo1[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo2[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo2[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo3[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo3[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo4[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo4[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo5[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo5[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo6[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo6[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                    if($combo7[0][0]==$combo['ID_COMBO']){
                        $nombre = $combo['NOMBRE'];
                        $cantidad = $combo7[0][1];
                        echo "<span class='text-muted small'>x$cantidad $nombre</span>";
                    }
                }
                ?>
            </div>
            <div class="row mt-2">
                <h5 class="border-bottom text-danger">EMAIL</h5>
                <p class="small text-muted"><?php echo $userEmail?></p>
            </div>
          </div><!-- FIN Columna descripción pelicula-->
          <div class="col-md-9 px-0"><!-- Inicio columna boletos-->
            <div class="card">
                <div class="card-header">
                    <h5 class="fw-bold mb-0"><i class="fas fa-shopping-cart me-2"></i>Confirmación y pago</h5>
                    <p class="small text-muted mb-0">Observa el detalle de tu compra.</p>
                </div>
                <div class="card-body">
                <h5 class="text-muted mb-1 ">Detalle de la compra</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="row border-bottom">
                                <h5 class="card-title fw-bolder">Cinematrix - Multiplaza Tegucigalpa</h5>
                                <p class="text-muted small mb-2"><?php echo strtoupper($fechaES) ." " .$data['HORA_INICIO'] ?></p>
                            </div> 
                            <div class="row">
                            <h6 class="mt-3 mb-0 fw-bold">BUTACAS</h6>
                            <?php
                                if($_SESSION['cantADULTREGULAR']>0){
                                    //CONSULTA PRECIO
                                    $query = "SELECT * FROM BOLETO WHERE ID_BOLETO = 1";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $boleto = $stm->fetch(PDO::FETCH_ASSOC);
                                    $cantidad = $_SESSION['cantADULTREGULAR'];
                                    $total = $cantidad * $boleto['PRECIO'];
                                    $nombre = $boleto['NOMBRE'];
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='small text-muted mb-0'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                            <span class='small text-muted mb-0'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                                if($_SESSION['cantCINEPACKPAREJA2D']>0){
                                    $query = "SELECT * FROM BOLETO WHERE ID_BOLETO = 2";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $boleto = $stm->fetch(PDO::FETCH_ASSOC);
                                    $cantidad = $_SESSION['cantCINEPACKPAREJA2D']/2;
                                    $total = $cantidad * $boleto['PRECIO'];
                                    $nombre = $boleto['NOMBRE'];
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='small text-muted mb-0'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                            <span class='small text-muted mb-0'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                            ?>
                            <h6 class="mt-2 mb-0 fw-bold">ALIMENTOS Y BEBIDAS</h6>
                            <?php
                            foreach($snacks as $combo){
                                if($combo1[0][0]==$combo['ID_COMBO']){
                                    $query = "SELECT * FROM COMBO WHERE ID_COMBO = 1";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $comb1 = $stm->fetch(PDO::FETCH_ASSOC);
                                    $nombre = $combo['NOMBRE'];
                                    $cantidad = $combo1[0][1];
                                    $total = $comb1['PRECIO'] * $cantidad;
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='text-muted small'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                                <span class='text-muted small'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                                if($combo2[0][0]==$combo['ID_COMBO']){
                                    $query = "SELECT * FROM COMBO WHERE ID_COMBO = 2";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $comb2 = $stm->fetch(PDO::FETCH_ASSOC);
                                    $nombre = $combo['NOMBRE'];
                                    $cantidad = $combo2[0][1];
                                    $total = $comb2['PRECIO'] * $cantidad;
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='text-muted small'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                                <span class='text-muted small'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                                if($combo3[0][0]==$combo['ID_COMBO']){
                                    $query = "SELECT * FROM COMBO WHERE ID_COMBO = 3";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $comb3 = $stm->fetch(PDO::FETCH_ASSOC);
                                    $nombre = $combo['NOMBRE'];
                                    $cantidad = $combo3[0][1];
                                    $total = $comb3['PRECIO'] * $cantidad;
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='text-muted small'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                                <span class='text-muted small'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                                if($combo4[0][0]==$combo['ID_COMBO']){
                                    $query = "SELECT * FROM COMBO WHERE ID_COMBO = 4";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $comb4 = $stm->fetch(PDO::FETCH_ASSOC);
                                    $nombre = $combo['NOMBRE'];
                                    $cantidad = $combo4[0][1];
                                    $total = $comb4['PRECIO'] * $cantidad;
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='text-muted small'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                                <span class='text-muted small'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                                if($combo5[0][0]==$combo['ID_COMBO']){
                                    $query = "SELECT * FROM COMBO WHERE ID_COMBO = 5";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $comb5 = $stm->fetch(PDO::FETCH_ASSOC);
                                    $nombre = $combo['NOMBRE'];
                                    $cantidad = $combo5[0][1];
                                    $total = $comb5['PRECIO'] * $cantidad;
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='text-muted small'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                                <span class='text-muted small'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                                if($combo6[0][0]==$combo['ID_COMBO']){
                                    $query = "SELECT * FROM COMBO WHERE ID_COMBO = 6";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $comb6 = $stm->fetch(PDO::FETCH_ASSOC);
                                    $nombre = $combo['NOMBRE'];
                                    $cantidad = $combo6[0][1];
                                    $total = $comb6['PRECIO'] * $cantidad;
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='text-muted small'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                                <span class='text-muted small'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                                if($combo7[0][0]==$combo['ID_COMBO']){
                                    $query = "SELECT * FROM COMBO WHERE ID_COMBO = 7";
                                    $stm = $conexion->prepare($query);
                                    $stm->execute();
                                    $comb7 = $stm->fetch(PDO::FETCH_ASSOC);
                                    $nombre = $combo['NOMBRE'];
                                    $cantidad = $combo7[0][1];
                                    $total = $comb7['PRECIO'] * $cantidad;
                                    $subtotal = $subtotal + $total;
                                    echo "<div class='row'>
                                            <div class='col-md-4'>
                                                <span class='text-muted small'>x$cantidad $nombre</span>
                                            </div>
                                            <div class='col-md-8 text-end'>
                                                <span class='text-muted small'>L" .number_format($total,2)."</span>
                                            </div>
                                        </div>";
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-8 text-end text-muted small">
                                    <span>Subtotal</span>
                                </div>
                                <div class="col-md-4 text-end text-muted small">
                                    <span>L<?php echo number_format($subtotal,2)?></span>
                                </div>
                                <div class="col-md-8 text-end text-muted small">
                                    <span>Descuentos</span>
                                </div>
                                <div class="col-md-4 text-end text-muted small">
                                    <span>L<?php echo number_format($descuento,2)?></span>
                                </div>
                                <div class="col-md-8 text-end text-muted small">
                                    <span>+ Cargo por servicios</span>
                                </div>
                                <div class="col-md-4 text-end text-muted small">
                                    <span>L 25.00</span>
                                </div>
                                <div class="col-md-8 text-end">
                                    <span class="text-danger fw-bold">TOTAL A PAGAR</span>
                                </div>
                                <div class="col-md-4 text-end text-muted">
                                    <?php
                                    $totalCompra = $subtotal + $descuento + $cargoServicios;
                                    ?>
                                    <span class="text-danger fw-bold">L <?php echo number_format($totalCompra,2)?></span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h5 class="fw-bold ms-3 text-muted">Realiza tu pago</h5>
                    <div class="text-center mt-2" id="paypal"></div>
                </div>  
            </div>
           
          </div><!-- FIN Columna Boletos--> 
          <div class="text-end mt-4">
                <a href="snacks.php?id=<?php echo $id?>" class="btn btn-danger btn-sm mt-2">Volver</a>
                <a href="#" class="btn btn-danger btn-sm mt-2" id="continuar">Pagar</a>
            </div> 
        </div>        
      </div> 
        
      <!-- FIN Cuerpo-->
  </div> <!-- FIN CONTAINER PRINCIPAL -->
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
    <script src="assets/js/jquery.js"></script>
</body>
</html>

<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: <?php echo number_format($totalCompra*$conversion,2)?>
          }
        }]
      });
    },
    onApprove: function(data, actions) {
        console.log("Compra realizada");
    }
  }).render('#paypal');
  //This function displays Smart Payment Buttons on your web page.
  
</script>
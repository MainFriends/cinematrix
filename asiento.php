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
        }else{
            header("location:login.php");
        }

        //Obtenemos el id de la cartelera
        $id = $_GET['id'];

        //CONSULTA CARTELERA
        $query = "SELECT CARTELERA.ID_PELICULA, PORTADA, FORMATO, ID_IDIOMA, TITULO, FECHA, DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO
        FROM PELICULA, CARTELERA, FORMATO
        WHERE PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
        AND CARTELERA.ID_FORMATO = FORMATO.ID_FORMATO
        AND ID_CARTELERA = '$id'";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);

        $fechaES = utf8_encode(strftime('%A %d %B %Y', strtotime($data['FECHA'])));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elige tu asiento - Cinematrix</title>
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

    .contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
    }
    .centrado{
        position: absolute;
        bottom: 0;
        right: 10px;
        left: 9px;
        top: 6px;
        font-size: x-small;
        pointer-events: none;
    }
  </style>
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
                     <a class="nav-link" aria-current="page" href="peliculas.php">PEL??CULAS</a>
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
                        <li><a class='dropdown-item' href='inc/logout.php'><i class='fas fa-sign-out-alt me-2'></i>Cerrar sesi??n</a></li>
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
                        <li><a class='dropdown-item' href='inc/logout.php'><i class='fas fa-sign-out-alt me-2'></i>Cerrar sesi??n</a></li>
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
                          <label class="label-control" for="">Correo electr??nico</label>
                          <input class="form-control" name="correo" type="text">
                          <label class="label-control" for="">Contrase??a</label>
                          <input class="form-control" name="pass" type="password">
                          <div class="py-1">
                             <input type="checkbox" name="connected" class="form-check-input">
                             <label for="connected" class="form-check-label">Mantenerme conectado</label>
                          </div>
                          <div class="py-1 d-grid">
                             <button type="submit" class=" d-grid btn btn-primary" name="login" >Iniciar sesi??n</button>
                          </div>
                          <p class="small">??No tienes una cuenta? <a href="signup.php">Reg??strate</a></p>
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
          <!-- Columna descripci??n pelicula-->
          <div class="col-md-3">
            <div class="row">
                <img src="<?php echo $data['PORTADA'] ?>" alt="">
            </div>
            <div class="row mt-3">
                <h5 class="border-bottom text-danger">TITULO ORIGINAL</h5>
                <p class="text-muted"><?php echo $data['TITULO'] ?></p>
            </div>
            <div class="row">
                <h5 class="border-bottom text-danger">FORMATO/IDIOMA</h5>
                <div class="col-md-1">
                    <button class="btn btn-secondary btn-sm" disabled><?php echo $data['FORMATO'] ?></button>
                </div>
                <?php
                if($data['ID_IDIOMA']==1){
                    echo "<div class='col-md-1 ms-3'>
                    <button class='btn btn-secondary btn-sm' disabled>DOB</button>
                </div>";
                }else{
                    echo "<div class='col-md-1 ms-3'>
                    <button class='btn btn-secondary btn-sm' disabled>SUB</button>
                </div>";
                }
                ?>
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
                    echo "<p class='small text-muted mb-0'>$cantidad ADULTREGULAR2D-CM</p>";
                }
                if($_SESSION['cantCINEPACKPAREJA2D']>0){
                    $cantidad = $_SESSION['cantCINEPACKPAREJA2D']/2;
                    echo "<p class='small text-muted'>$cantidad CINEPAREJA2D-CM</p>";
                }
                ?>
            </div>
            <div class="row">
                <h5 class="border-bottom text-danger">EMAIL</h5>
                <p class="small text-muted"><?php echo $userEmail?></p>
            </div>
          </div><!-- FIN Columna descripci??n pelicula-->
          <div class="col-md-9 px-0"><!-- Inicio columna boletos--> 
          <div class="container shadow pb-3 rounded bg-light">
        <div class="row">
            <div class="card-header">
            <h5 class="fw-bold mb-0"><i class="fas fa-couch me-2"></i>Elige tu asiento</h5>
            <p class="small text-muted mb-0">Si??ntete c??modo.</p>
            </div>
            <div class="text-center mb-4 mt-3">
            <img src="assets/img/butacas/butaca_disponible.svg" width="26px" height="26px"> <span class="mt-2 text-muted small">Disponible</span>
            <img src="assets/img/butacas/butaca_seleccionado.svg" width="26px" height="26px"> <span class="mt-2 text-muted small">Tu asiento</span>
            <img src="assets/img/butacas/butaca_ocupado.svg" width="26px" height="26px"> <span class="mt-2 text-muted small">Vendido</span>
            </div>
        </div>
        <div class="row">
            <div class="container mb-3">
                <div class="row mb-3">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="text-center bg-dark text-light">PANTALLA</div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <!-- FILA A -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">A</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'A%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $A = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($A as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">A</p>
                    </div>
                    <!-- FILA B -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">B</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'B%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $B = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($B as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">B</p>
                    </div>
                    <!-- FILA C -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">C</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'C%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $C = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($C as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">C</p>
                    </div>
                    <!-- FILA D -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">D</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'D%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $D = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($D as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">D</p>
                    </div>
                    <!-- FILA E -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">E</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'E%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $E = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($E as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">E</p>
                    </div>
                    <!-- FILA F -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">F</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'F%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $F = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($F as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">F</p>
                    </div>
                    <!-- FILA G -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">G</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'G%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $G = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($G as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">G</p>
                    </div>
                    <!-- FILA H -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">H</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'H%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $H = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($H as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">H</p>
                    </div>
                    <!-- FILA I -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">I</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'I%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $I = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($I as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">I</p>
                    </div>
                    <!-- FILA J -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">J</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'J%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $J = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($J as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">J</p>
                    </div>
                    <!-- FILA K -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">K</p>
                    </div>
                    <div class="col-md-10 text-center">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'K%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $K = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($K as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                        <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">K</p>
                    </div>
                    <!-- FILA L -->
                    <div class="col-md-1 text-center">
                    <p class="fw-bold">L</p>
                    </div>
                    <div class="col-md-10 text-center px-0">
                    <?php
                    $query = "SELECT * FROM ASIENTO
                    WHERE NUM_ASIENTO LIKE 'L%'";
                    $stm = $conexion->prepare($query);
                    $stm->execute();
                    $L = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $i = 1; //Inicializar contador de asientos
                    
                    foreach($L as $butaca){
                        //Determinamos la disponibilidad
                        if($butaca['ID_ESTADO']==1){
                            $estado = 'assets/img/butacas/butaca_disponible.svg';
                        }else{
                            $estado = 'assets/img/butacas/butaca_ocupado.svg';
                        }
                    ?>
                    <div class="contenedor text-center">
                        <img src="<?php echo $estado?>" id="<?php echo $butaca['ID_ASIENTO']?>" onclick="reply_click(this.id)" width="28px" height="28px">
                    <div class="centrado small"><?php echo $i?></div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>
                    </div>
                    <div class="col-md-1 text-center">
                        <p class="fw-bold">L</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
            <div class="text-end mt-4">
                <a href="boletos.php?id=<?php echo $id?>" class="btn btn-danger btn-sm mt-2">Volver</a>
                <a href="snacks.php?id=<?php echo $id?>" class="btn btn-danger btn-sm mt-2" id="continuar">Continuar</a>
            </div> 
          </div><!-- FIN Columna Boletos--> 
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
                    <h6 class="border-bottom">PROGRAMACI??N</h6>
                </div>
                <a style="text-decoration:none" href="#" class="text-secondary">Cartelera</a> <br>
                <a style="text-decoration:none" href="#" class="text-secondary">Pr??ximamente</a> <br>
                <a style="text-decoration:none" href="#" class="text-secondary">Preventa</a>
            </div>
            <div class="col-md-2">
                <div class="text-start">
                    <h6 class="border-bottom">SOBRE CINEMATRIX</h6>
                </div>
                <a style="text-decoration:none" href="#" class="text-secondary">??Quienes somos?</a> <br>
                <a style="text-decoration:none" href="#" class="text-secondary">T??rminos y condiciones</a>
            </div>
            <div class="col-md-2">
                <div class="text-start">
                    <h6 class="border-bottom">CONT??CTENOS</h6>
                </div>
                <a style="text-decoration:none" href="#" class="text-secondary">Escr??benos</a> <br>
                <a style="text-decoration:none" href="#" class="text-secondary">Trabaje con nosotros</a>
            </div>
        </div>
    </div>
  </footer>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/asientos.js"></script>
</body>
</html>

<script>
$("#continuar").addClass('disabled'); //Desactivar boton continuar
var butacas = 0;
var cantidad = <?php echo $_SESSION['cantADULTREGULAR']?> + <?php echo $_SESSION['cantCINEPACKPAREJA2D']?>;
var arreglo = []

function reply_click(clicked_id){

    if (document.getElementById(clicked_id).src == 'http://localhost/cinematrix/assets/img/butacas/butaca_disponible.svg' && butacas < cantidad) 
    {
        document.getElementById(clicked_id).src = 'assets/img/butacas/butaca_seleccionado.svg';
        butacas = butacas + 1

        //Extraemos el id del asiento seleccionado
        asiento = document.getElementById(clicked_id).id

        //Agregamos el asiento al array
        arreglo.push(asiento)
    }
    else if(document.getElementById(clicked_id).src == 'http://localhost/cinematrix/assets/img/butacas/butaca_seleccionado.svg')
    {
        document.getElementById(clicked_id).src = 'assets/img/butacas/butaca_disponible.svg';
        butacas = butacas - 1

        //Extraemos el id del asiento seleccionado
        asiento = document.getElementById(clicked_id).id

        //Ubicamos la posicion en el arreglo del elemento que eliminaremos del array
        let pos = arreglo.indexOf(asiento)
        //Eliminamos
        arreglo.splice(pos, 1)
    }

    //Habilitar / desabilitad boton continuar
    if(butacas == cantidad){
        $("#continuar").removeClass('disabled');
    }else{
        $("#continuar").addClass('disabled');
    }

    //Pasar cantidad de boletos por ajax
    $("#continuar").click(function(){
        $.ajax({
        method:"POST",
        url:"inc/detalleVenta.php",
        data:{ arreglo },
        success:function(response){
           console.log("response");
        }
     });
    }); 
    
} 
</script>
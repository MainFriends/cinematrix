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

        //Obtenemos los asientos del usuario
        $userAsientos = $_SESSION['butacas'];

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
    <title>Alimentos y bebidas - Cinematrix</title>
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
                    echo "<p class='small text-muted mb-0'>$cantidad ADULTREGULAR-HO</p>";
                }
                if($_SESSION['cantCINEPACKPAREJA2D']>0){
                    $cantidad = $_SESSION['cantCINEPACKPAREJA2D']/2;
                    echo "<p class='small text-muted'>$cantidad CINEPACKPAREJA2D-HN</p>";
                }
                ?>
            </div>
            <div class="row">
                <h5 class="border-bottom text-danger">BUTACAS</h5>
                <span class="text-muted small">
                <?php
                foreach($userAsientos as $asientosUser){
                    foreach($asientos as $butacas){
                        if($asientosUser == $butacas['ID_ASIENTO']){
                            $nombre = $butacas['NUM_ASIENTO'];
                            echo "$nombre ";
                        }
                    }
                }
                ?>
                </span>
            </div>
            <div class="row mt-2">
                <h5 class="border-bottom text-danger">EMAIL</h5>
                <p class="small text-muted"><?php echo $userEmail?></p>
            </div>
          </div><!-- FIN Columna descripción pelicula-->
          <div class="col-md-9 px-0"><!-- Inicio columna boletos-->
           <div class="card">
                <div class="card-header">
                    <h5 class="fw-bold mb-0"><i class="fas fa-hotdog me-2"></i>Alimentos y bebidas</h5>
                    <p class="small text-muted mb-0">Elige tus snacks de preferencia.</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                            foreach($snacks as $snack){
                        ?>
                        <div class="col-md-6">
                            <div class="card mb-2">
                                <div class="card-body py-2 px-2">
                                    <div class="row">
                                        <div class="col-md-6 px-2 text-center">
                                            <img src="<?php echo $snack['IMAGEN']?>" alt="" width="130px" height="150px">
                                        </div>
                                        <div class="col-md-6 px-3">
                                            <h6 class="fw-bold"><?php echo $snack['NOMBRE']?></h6>
                                            <p class="small text-muted"><?php echo $snack['DESCRIPCION']?></p>
                                            <p class="fw-bold small mt-3 text-end">Precio: L <?php echo number_format($snack['PRECIO'],2)?></p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-9 text-end px-0">
                                            <p class="text-muted mt-1">Cantidad:</p>
                                            </div>
                                            <div class="col-md-3 text-end">
                                                <input class="form-control form-control-sm mb-2" id="<?php echo $snack['ID_COMBO']?>" onclick="reply_click(this.id)" type="number" min="0" max="10" value="0" style="width: 5rem;">
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
                <div class="row">
                    <div class="col-md-9">
                        <div class="row mx-3">
                            <div class="col-md-6">
                                <div id="NOMBRECOMBO1"></div>
                                <div id="NOMBRECOMBO2"></div>
                                <div id="NOMBRECOMBO3"></div>
                                <div id="NOMBRECOMBO4"></div>
                                <div id="NOMBRECOMBO5"></div>
                                <div id="NOMBRECOMBO6"></div>
                                <div id="NOMBRECOMBO7"></div>
                            </div>
                            <div class="col-md-2">
                                <div id="CANTCOMB1"></div>
                                <div id="CANTCOMB2"></div>
                                <div id="CANTCOMB3"></div>
                                <div id="CANTCOMB4"></div>
                                <div id="CANTCOMB5"></div>
                                <div id="CANTCOMB6"></div>
                                <div id="CANTCOMB7"></div>
                            </div>
                            <div class="col-md-4">
                                <div id="PRECIOCOMB1"></div>
                                <div id="PRECIOCOMB2"></div>
                                <div id="PRECIOCOMB3"></div>
                                <div id="PRECIOCOMB4"></div>
                                <div id="PRECIOCOMB5"></div>
                                <div id="PRECIOCOMB6"></div>
                                <div id="PRECIOCOMB7"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 id="total"></h4>
                    </div>
                </div>
            </div>
          </div><!-- FIN Columna Boletos--> 
          <div class="text-end mt-4">
                <a href="asiento.php?id=<?php echo $id?>" class="btn btn-danger btn-sm mt-2">Volver</a>
                <a href="purchase.php?id=<?php echo $id?>" class="btn btn-danger btn-sm mt-2" id="continuar">Continuar</a>
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
    var precio = 0;
    var total = 0.00;
    var cantidad = 0;

    // COMBOS
    var personal = 0;
    var WK = 0;
    var compartir = 0;
    var nacho = 0;
    var soda_grande = 0;
    var soda_mediana = 0;
    var agua = 0;
    
    var combo1  = [[0,0]];
    var combo2  = [[0,0]];
    var combo3  = [[0,0]];
    var combo4  = [[0,0]];
    var combo5  = [[0,0]];
    var combo6  = [[0,0]];
    var combo7  = [[0,0]];

    $(document).ready(function(){
        $("#total").text('Total L'+(Math.round(total * 100) / 100).toFixed(2));
    });

    function reply_click(clicked_id){
        id = document.getElementById(clicked_id).id
        cantidad = document.getElementById(clicked_id).value

        $.ajax({
            type:'POST',
            url:'inc/getCombo.php',
            dataType: "json",
            data:{id:id},
            success:function(data){ 
                precio = data.PRECIO
                subtotal = precio * cantidad
                if(id==1){
                    personal = subtotal
                    if(cantidad>0){
                        $('#NOMBRECOMBO1').show(); //Mostrar div
                        $('#CANTCOMB1').show();
                        $('#PRECIOCOMB1').show();
                        $("#NOMBRECOMBO1").text(data.NOMBRE);
                        $("#CANTCOMB1").text("x"+cantidad);
                        $("#PRECIOCOMB1").text("L"+(Math.round(personal * 100) / 100).toFixed(2));
                        combo1  = [[id, cantidad]]; 
                    }else{
                        $('#NOMBRECOMBO1').hide(); //OCULTAR DIV
                        $('#CANTCOMB1').hide();
                        $('#PRECIOCOMB1').hide();
                        combo1  = [[0,0]];
                    }
                }else if(id==2){
                    WK = subtotal
                    if(cantidad>0){
                        $('#NOMBRECOMBO2').show(); //Mostrar div
                        $('#CANTCOMB2').show();
                        $('#PRECIOCOMB2').show();
                        $("#NOMBRECOMBO2").text(data.NOMBRE);
                        $("#CANTCOMB2").text("x"+cantidad);
                        $("#PRECIOCOMB2").text("L"+(Math.round(WK * 100) / 100).toFixed(2));
                        combo2  = [[id, cantidad]];  
                    }else{
                        $('#NOMBRECOMBO2').hide(); //OCULTAR DIV
                        $('#CANTCOMB2').hide();
                        $('#PRECIOCOMB2').hide();
                        combo2  = [[0,0]]; 
                    }
                }else if(id==3){
                    compartir = subtotal
                    if(cantidad>0){
                        $('#NOMBRECOMBO3').show(); //Mostrar div
                        $('#CANTCOMB3').show();
                        $('#PRECIOCOMB3').show();
                        $("#NOMBRECOMBO3").text(data.NOMBRE);
                        $("#CANTCOMB3").text("x"+cantidad);
                        $("#PRECIOCOMB3").text("L"+(Math.round(compartir * 100) / 100).toFixed(2));
                        combo3  = [[id, cantidad]]; 
                    }else{
                        $('#NOMBRECOMBO3').hide(); //OCULTAR DIV
                        $('#CANTCOMB3').hide();
                        $('#PRECIOCOMB3').hide();
                        combo3  = [[0,0]];
                    }
                }else if(id==4){
                    nacho = subtotal
                    if(cantidad>0){
                        $('#NOMBRECOMBO4').show(); //Mostrar div
                        $('#CANTCOMB4').show();
                        $('#PRECIOCOMB4').show();
                        $("#NOMBRECOMBO4").text(data.NOMBRE);
                        $("#CANTCOMB4").text("x"+cantidad);
                        $("#PRECIOCOMB4").text("L"+(Math.round(nacho * 100) / 100).toFixed(2));
                        combo4  = [[id, cantidad]]; 
                    }else{
                        $('#NOMBRECOMBO4').hide(); //OCULTAR DIV
                        $('#CANTCOMB4').hide();
                        $('#PRECIOCOMB4').hide();
                        combo4  = [[0,0]];
                    }
                }else if(id==5){
                    soda_grande = subtotal
                    if(cantidad>0){
                        $('#NOMBRECOMBO5').show(); //Mostrar div
                        $('#CANTCOMB5').show();
                        $('#PRECIOCOMB5').show();
                        $("#NOMBRECOMBO5").text(data.NOMBRE);
                        $("#CANTCOMB5").text("x"+cantidad);
                        $("#PRECIOCOMB5").text("L"+(Math.round(soda_grande * 100) / 100).toFixed(2));
                        combo5  = [[id, cantidad]]; 
                    }else{
                        $('#NOMBRECOMBO5').hide(); //OCULTAR DIV
                        $('#CANTCOMB5').hide();
                        $('#PRECIOCOMB5').hide();
                        combo5  = [[0,0]];
                    }
                }else if(id==6){
                    soda_mediana = subtotal
                    if(cantidad>0){
                        $('#NOMBRECOMBO6').show(); //Mostrar div
                        $('#CANTCOMB6').show();
                        $('#PRECIOCOMB6').show();
                        $("#NOMBRECOMBO6").text(data.NOMBRE);
                        $("#CANTCOMB6").text("x"+cantidad);
                        $("#PRECIOCOMB6").text("L"+(Math.round(soda_mediana * 100) / 100).toFixed(2));
                        combo6  = [[id, cantidad]]; 
                    }else{
                        $('#NOMBRECOMBO6').hide(); //OCULTAR DIV
                        $('#CANTCOMB6').hide();
                        $('#PRECIOCOMB6').hide();
                        combo6  = [[0,0]];
                    }
                }else if(id==7){
                    agua = subtotal
                    if(cantidad>0){
                        $('#NOMBRECOMBO7').show(); //Mostrar div
                        $('#CANTCOMB7').show();
                        $('#PRECIOCOMB7').show();
                        $("#NOMBRECOMBO7").text(data.NOMBRE);
                        $("#CANTCOMB7").text("x"+cantidad);
                        $("#PRECIOCOMB7").text("L"+(Math.round(agua * 100) / 100).toFixed(2));
                        combo7  = [[id, cantidad]]; 
                    }else{
                        $('#NOMBRECOMBO7').hide(); //OCULTAR DIV
                        $('#CANTCOMB7').hide();
                        $('#PRECIOCOMB7').hide();
                        combo7  = [[0,0]];
                    }
                }
                total = personal + WK + compartir + nacho + soda_grande + soda_mediana + agua
                $("#total").text('Total L'+(Math.round(total * 100) / 100).toFixed(2));

            },error(response){
                console.log(response)
            }
        });
    }
    $("#continuar").click(function(){
        $.ajax({
        method:"POST",
        url:"inc/detalleVenta.php",
        data:{ combo1, combo2, combo3, combo4, combo5, combo6, combo7 },
        success:function(response){
           console.log(response);
        }
        });
    });

</script>
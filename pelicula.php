<?php
        session_start();
        require_once "inc/config.php";

        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $id = $_GET['id'];

        //CONSULTA PELICULA
        $query = "SELECT TITULO, DURACION, GENERO, CLASIFICACION, SINOPSIS, PORTADA
        FROM PELICULA, GENERO, CLASIFICACION
        WHERE PELICULA.ID_GENERO = GENERO.ID_GENERO
        AND PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
        AND ID_PELICULA = '$id'";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);

        /*

        //CONSULTA CARTELERA
        $queryC1 = "SELECT IDIOMA, SUBTITULO, FORMATO
        FROM CARTELERA, IDIOMA, SUBTITULO, FORMATO
        WHERE CARTELERA.ID_IDIOMA = IDIOMA.ID_IDIOMA
        AND CARTELERA.ID_SUB = SUBTITULO.ID_SUB
        AND CARTELERA.ID_FORMATO = FORMATO.ID_FORMATO 
        AND ID_PELICULA = '$id'
        AND FECHA = '$fecha'";
        $stm = $conexion->prepare($queryC1);
        $stm->execute();
        $dataC1 = $stm->fetch(PDO::FETCH_ASSOC);

        //CONSULTAR HORA INICIO
        $queryHI1 = "SELECT DATE_FORMAT(HORA_INICIO, '%H:%i') HORA_INICIO FROM CARTELERA
        WHERE ID_PELICULA = '$id'
        AND FECHA = '$fecha'";
        $stm = $conexion->prepare($queryHI1);
        $stm->execute();
        $dataHI1 = $stm->fetchAll(PDO::FETCH_ASSOC);*/

        $queryDate = "SELECT DISTINCT FECHA FROM CARTELERA
        WHERE ID_PELICULA = '$id'
        AND FECHA >= CURDATE()";
        $stm = $conexion->prepare($queryDate);
        $stm->execute();
        $dataDate = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelicula - Cinematrix</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
  <div class="container-fluid"> <!-- CONTAINER PRINCIPAL -->
    <!-- NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
          <img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="70" alt="">
          <span class="me-2 fs-3 fw-bold mb-0">Cinematrix</span>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
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
                      <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">PROMOCIONES</a>
                  </li>
              </ul>
              <div class="nav-item dropdown">
                  <a class="btn btn-danger dropdown" href="#" role="button" id="dropdownMenuLink"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      Ingresar
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" style="width: 300px"
                      aria-labelledby="navbarDropdown">
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
              </div>
          </div>
        </div>
      </nav>
      <!-- FIN NAV -->

      <!-- Cuerpo-->
      <div class="container">
        <div class="row my-4">
          <!-- Columna descripción pelicula-->
          <div class="col-md-3">
            <div class="row">
                <img src="<?php echo $data['PORTADA'] ?>" alt="">
            </div>
            <div class="row py-3">
                <h5 class="border-bottom text-danger">TITULO ORIGINAL</h5>
                <p><?php echo $data['TITULO'] ?></p>
            </div>
            <div class="row">
                <h5 class="border-bottom text-danger">SINOPSIS </h5>
                <p><?php echo $data['SINOPSIS'] ?></p>
            </div>
          </div><!-- FIN Columna descripción pelicula-->
          <!-- Inicio Columna Cartelera-->  
          <div class="col-md-9">
            <?php
              foreach($dataDate as $fecha){
                $date = $fecha['FECHA'];
                $queryHI = "SELECT DATE_FORMAT(HORA_INICIO, '%H:%i') HORA_INICIO FROM CARTELERA
                WHERE ID_PELICULA = '$id'
                AND FECHA = '$date'";
                $stm = $conexion->prepare($queryHI);
                $stm->execute();
                $dataHI = $stm->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="card my-2">
              <div class="card-header">
                <?php echo $fecha['FECHA']?> - Multiplaza Tegucigalpa
              </div>
              <div class="card-body">
                <p class="card-text">*Los horarios aquí expuestos representan el inicio de cada función</p>
                <?php foreach($dataHI as $HI){?>
                <a href="#" class="btn btn-primary"><?php echo $HI['HORA_INICIO']?></a>
                <?php
                }
                ?>
              </div>
            </div>
            <?php
              }
            ?>
          </div><!-- FIN Columna Cartelera-->  
        </div>        
      </div> 
        

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
</body>
</html>
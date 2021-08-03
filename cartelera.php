<?php 
  setlocale(LC_TIME, 'Spanish');      
  session_start();
  require_once 'inc/session.php';
  $_SESSION['pag'] = 'pelicula';
  if(isset($_SESSION['usuario'])){
      $userSession = $_SESSION['usuario'];
  }

  // FECHA 1
  $query = "SELECT DISTINCT TITULO, PELICULA.ID_PELICULA, PORTADA, CLASIFICACION, DURACION
  FROM PELICULA, CLASIFICACION, CARTELERA
  WHERE PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
  AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
  AND FECHA = '2021/08/03'";
  $stm = $conexion->prepare($query);
  $stm->execute();
  $data = $stm->fetchAll(PDO::FETCH_ASSOC);

  // FECHA 2
  $query = "SELECT DISTINCT TITULO, PELICULA.ID_PELICULA, PORTADA, CLASIFICACION, DURACION
  FROM PELICULA, CLASIFICACION, CARTELERA
  WHERE PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
  AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
  AND FECHA = '2021/08/03'";
  $stm = $conexion->prepare($query);
  $stm->execute();
  $data2 = $stm->fetchAll(PDO::FETCH_ASSOC);

  // FECHA 3
  $query = "SELECT DISTINCT TITULO, PELICULA.ID_PELICULA, PORTADA, CLASIFICACION, DURACION
  FROM PELICULA, CLASIFICACION, CARTELERA
  WHERE PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
  AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
  AND FECHA = '2021/08/03'";
  $stm = $conexion->prepare($query);
  $stm->execute();
  $data3 = $stm->fetchAll(PDO::FETCH_ASSOC);

  // FECHA 4
  $query = "SELECT DISTINCT TITULO, PELICULA.ID_PELICULA, PORTADA, CLASIFICACION, DURACION
  FROM PELICULA, CLASIFICACION, CARTELERA
  WHERE PELICULA.ID_CLASIFICACION = CLASIFICACION.ID_CLASIFICACION 
  AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
  AND FECHA = '2021/08/03'";
  $stm = $conexion->prepare($query);
  $stm->execute();
  $data4 = $stm->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carteleras - Cinematrix</title>
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
            <a class="btn btn-danger dropdown" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
              aria-expanded="false">
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
          </div>
        </div>
      </div>
    </nav>
    <!--CUERPO-->

   


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
      </div>

    <div class="container">
      <div class="row">
        <div class="my-4 col-md-12">
          <!-- Nav tabs -->
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-dark active btn btn-outline-dark me-1" id="pills-taquilla-tab" data-bs-toggle="pill"
                data-bs-target="#pills-taquilla" type="button" role="tab" aria-controls="pills-taquilla"
                aria-selected="true">EN CARTELERA</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-dark btn btn-outline-dark" id="pills-dulce-tab" data-bs-toggle="pill"
                data-bs-target="#pills-dulce" type="button" role="tab" aria-controls="pills-dulce"
                aria-selected="false">PREVENTA</button>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-taquilla" role="tabpanel"
              aria-labelledby="pills-taquilla-tab">


              <div class="tab-content" id="pills-tabContent">
                <ul class="nav justify-content-center" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-secondary me-1" id="pills-lunesc-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-lunesc" type="button" role="tab" aria-controls="pills-lunesc"
                      aria-selected="true">JUE. 05/08/2021</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-secondary me-1" id="pills-martesc-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-martesc" type="button" role="tab" aria-controls="pills-martesc"
                      aria-selected="false">VIE. 06/08/2021</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-secondary me-1" id="pills-miercolesc-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-miercolesc" type="button" role="tab" aria-controls="pills-miercolesc"
                      aria-selected="false">SAB. 07/08/2021</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-secondary me-1" id="pills-juevesc-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-juevesc" type="button" role="tab" aria-controls="pills-juevesc"
                      aria-selected="false">DOM. 08/08/2021</button>
                  </li>
                </ul>


                <div class="tab-pane fade show my-4 active" id="pills-lunesc" role="tabpanel" aria-labelledby="pills-lunesc-tab">
                    <?php
                      foreach($data as $datos){
                        $id = $datos['ID_PELICULA'];

                        // DOBLADA AL ESPAÑOL
                        $queryDOB = "SELECT DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '2021/08/03'
                        AND ID_IDIOMA = 1";
                        $stm = $conexion->prepare($queryDOB);
                        $stm->execute();
                        $dataHI = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulDOB = $stm->rowCount(); //Obtenemos el numero de filas afectadas

                        // ORIGINAL/SUBTITULADA
                        $querySUB = "SELECT DATE_FORMAT(HORA_INICIO, '%I:%i %p') HORA_INICIO FROM CARTELERA
                        WHERE ID_PELICULA = '$id'
                        AND FECHA = '2021/08/03'
                        AND ID_IDIOMA = 2";
                        $stm = $conexion->prepare($querySUB);
                        $stm->execute();
                        $dataSUB = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $resulSUB = $stm->rowCount();
                    ?>
                  <div class="row my-3">
                    <div class="col-md-4">
                      <img src="<?php echo $datos['PORTADA']?>" class="rounded mx-auto d-block" width="50%"
                        alt="...">
                    </div>
                    <div class="col-md-8">
                      <h5 class="card-title"><?php echo $datos['TITULO']?></h5>
                      <div class="d-grid gap-2 d-md-block my-3">
                          <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled><?php echo $datos['CLASIFICACION']?></button></abbr>
                          <button class="btn btn-outline-secondary btn-sm" disabled><?php echo $datos['DURACION']?></button>
                      </div>
                        <!--TARJETA-->
                        <div class="card my-2">
                          <div class="card-header fw-bold">
                            Multiplaza Tegucigalpa
                          </div>
                          <div class="card-body">
                            <p class="card-text fw-lighter">*Los horarios aquí expuestos representan el inicio de cada función</p>
                        
                            <?php
                            // Si hay resultados para peliculas dobladas ejecuta esta sentencia
                            if($resulDOB >= 1){
                            ?>
                                <p class="fw-bold"><span class="badge bg-secondary">DOB</span>
                                    <?php foreach($dataHI as $HIDOB){?>
                                    <a href="#" class="btn btn-danger btn-sm"><?php echo $HIDOB['HORA_INICIO']?></a>
                                    <?php
                                    }
                                    ?>
                                </p>
                            <?php
                            }
                            ?>
                            <?php
                            // Si hay resultados para peliculas subtituladas ejecuta esta sentencia
                            if($resulSUB >= 1){
                            ?>
                                <p class="fw-bold"><span class="badge bg-secondary">SUB</span>
                                    <?php foreach($dataSUB as $HISUB){?>
                                    <a href="#" class="btn btn-danger btn-sm"><?php echo $HISUB['HORA_INICIO']?></a>
                                    <?php
                                    }
                                    ?>
                                </p>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                    </div> <!-- FIN COL-8 -->
                  
                  </div> <!-- FIN ROW -->
                    <?php
                      }
                    ?>
                </div> <!-- FIN TAB -->
                <div class="tab-pane fade my-4" id="pills-martesc" role="tabpanel"
                  aria-labelledby="pills-martesc-tab">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="card mb-3 border-0">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="https://static.cinepolis.com/resources/mx/movies/posters/414x603/36299-264342-20210624094914.jpg" class="rounded mx-auto d-block" width="50%"
                              alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">Black Widow</h5>
                              <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                              </div>
                              <!--tarjeta interna-->
                              <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                <div class="card-header">
                                  <div class="d-grid gap-2 d-md-block">
                                    <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                    <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <h6>
                                    <p class="card-text">*Los horarios aquí expuestos representan el inicio de cada función.
                                    </p>
                                  </h6>
                                  <button type="button" class="btn btn-outline-danger">18:10</button>
                                </div>
                              </div>
    
    
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
    
                  </div>
                
                </div>
                  <div class="tab-pane fade my-4" id="pills-miercolesc" role="tabpanel" aria-labelledby="pills-miercolesc-tab">
                    
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card mb-3 border-0">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <img src="https://static.cinepolis.com/resources/mx/movies/posters/414x603/36299-264342-20210624094914.jpg" class="rounded mx-auto d-block" width="50%"
                                alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">Black Widow</h5>
                                <div class="d-grid gap-2 d-md-block my-3">
                                  <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                  <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                </div>
                                <!--tarjeta interna-->
                                <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                  <div class="card-header">
                                    <div class="d-grid gap-2 d-md-block">
                                      <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                      <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                    </div>
                                  </div>
                                  <div class="card-body">
                                    <h6>
                                      <p class="card-text">*Los horarios aquí expuestos representan el inicio de cada función.
                                      </p>
                                    </h6>
                                    <button type="button" class="btn btn-outline-danger">16:10</button>
                                    <button type="button" class="btn btn-outline-danger">19:10</button>
                                  </div>
                                </div>
      
      
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--segunda tarjeta-->
                      <div class=" my-4 col-md-12">
                        <div class="card mb-3 border-0">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <img src="https://www.ecartelera.com/carteles/13100/13120/002_p.jpg" class="rounded mx-auto d-block" width="50%"
                                alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">Space Jam</h5>
                                <div class="d-grid gap-2 d-md-block my-3">
                                  <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                  <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                </div>
                                <!--tarjeta interna-->
                                <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                  <div class="card-header">
                                    <div class="d-grid gap-2 d-md-block">
                                      <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                      <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                    </div>
                                  </div>
                                  <div class="card-body">
                                    <h6>
                                      <p class="card-text">*Los horarios aquí expuestos representan el inicio de cada función.
                                      </p>
                                    </h6>
                                    <button type="button" class="btn btn-outline-danger">16:10</button>
                                  </div>
                                </div>
      
      
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--final de la tarjeta-->
      
                    </div>
                  
                  </div>
                  <div class="tab-pane fade my-4" id="pills-juevesc" role="tabpanel" aria-labelledby="pills-juevesc-tab">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="card mb-3 border-0">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <img src="https://static.cinepolis.com/resources/mx/movies/posters/414x603/36299-264342-20210624094914.jpg" class="rounded mx-auto d-block" width="50%"
                                alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">Black Widow</h5>
                                <div class="d-grid gap-2 d-md-block my-3">
                                  <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                  <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                </div>
                                <!--tarjeta interna-->
                                <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                  <div class="card-header">
                                    <div class="d-grid gap-2 d-md-block">
                                      <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                      <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                    </div>
                                  </div>
                                  <div class="card-body">
                                    <h6>
                                      <p class="card-text">*Los horarios aquí expuestos representan el inicio de cada función.
                                      </p>
                                    </h6>
                                    <button type="button" class="btn btn-outline-danger">14:10</button>
                                  </div>
                                </div>
      
      
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--segunda tarjeta-->
                      <div class=" my-4 col-md-12">
                        <div class="card mb-3 border-0">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <img src="https://www.ecartelera.com/carteles/13100/13120/002_p.jpg" class="rounded mx-auto d-block" width="50%"
                                alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">Space Jam</h5>
                                <div class="d-grid gap-2 d-md-block my-3">
                                  <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                  <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                </div>
                                <!--tarjeta interna-->
                                <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                  <div class="card-header">
                                    <div class="d-grid gap-2 d-md-block">
                                      <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                      <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                    </div>
                                  </div>
                                  <div class="card-body">
                                    <h6>
                                      <p class="card-text">*Los horarios aquí expuestos representan el inicio de cada función.
                                      </p>
                                    </h6>
                                    <button type="button" class="btn btn-outline-danger">14:10</button>
                                    <button type="button" class="btn btn-outline-danger">16:10</button>
                                  </div>
                                </div>
      
      
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--final de la tarjeta-->
      
                    </div>

                  </div>


              </div>
            </div>


            <!--Panel preventa-->
            <div class="tab-pane fade" id="pills-dulce" role="tabpanel" aria-labelledby="pills-dulce-tab">
              <div class="row">
                <div class="my-2 col-md-12">

                  <ul class="nav justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="btn btn-outline-secondary me-2" id="pills-Pelicula1-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-Pelicula1" type="button" role="tab" aria-controls="pills-Pelicula1"
                        aria-selected="true"> <img src="https://www.ecartelera.com/carteles-series/600/681/007_p.jpg"
                          class="rounded mx-auto d-block" width="180" height="220" alt="..."></button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="btn btn-outline-secondary me-2" id="pills-Pelicula2-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-Pelicula2" type="button" role="tab" aria-controls="pills-Pelicula2"
                        aria-selected="true"><img src="https://www.portaldetuciudad.com/imagenes/cartelera/cartel5672.jpg"
                          class="rounded mx-auto d-block" width="180" height="220" alt="..."></button>
                    </li>

                  </ul><br>

                  <!--panel 1-->
                  <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade" id="pills-Pelicula1" role="tabpanel"
                      aria-labelledby="pills-Pelicula1-tab">

                      <div class="tab-content" id="pills-tabContent">
                        <ul class="nav justify-content-center" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-lunes-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-lunes" type="button" role="tab" aria-controls="pills-lunes"
                              aria-selected="true">LUN. 26.7.2021</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-martes-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-martes" type="button" role="tab" aria-controls="pills-martes"
                              aria-selected="false">MAR. 27.7.2021.</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-miercoles-tab"
                              data-bs-toggle="pill" data-bs-target="#pills-miercoles" type="button" role="tab"
                              aria-controls="pills-miercoles" aria-selected="false">MIÉ. 28.7.2021</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-jueves-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-jueves" type="button" role="tab" aria-controls="pills-jueves"
                              aria-selected="true">JUE. 29.7.2021</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-viernes-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-viernes" type="button" role="tab" aria-controls="pills-viernes"
                              aria-selected="false">VIE. 30.7.2021.</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-sab-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-sab" type="button" role="tab" aria-controls="pills-sab"
                              aria-selected="false">SÁB. 31.7.2021</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-dom-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-dom" type="button" role="tab" aria-controls="pills-dom"
                              aria-selected="false">DOM. 01.8.2021</button>
                          </li>
                        </ul>

                        <div class="tab-pane fade my-4" id="pills-lunes" role="tabpanel"
                          aria-labelledby="pills-lunes-tab">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.ecartelera.com/carteles-series/600/681/007_p.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">LA PURGA</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:10</button>
                                          <button type="button" class="btn btn-outline-danger">19:30</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade show active my-4" id="pills-martes" role="tabpanel"
                          aria-labelledby="pills-martes-tab">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.ecartelera.com/carteles-series/600/681/007_p.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">LA PURGA</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:20</button>
                                          <button type="button" class="btn btn-outline-danger">19:40</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade my-4" id="pills-miercoles" role="tabpanel"
                          aria-labelledby="pills-miercoles-tab">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.ecartelera.com/carteles-series/600/681/007_p.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">LA PURGA</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:10</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>



                        </div>
                        <div class="tab-pane fade my-4" id="pills-jueves" role="tabpanel"
                          aria-labelledby="pills-jueves-tab">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.ecartelera.com/carteles-series/600/681/007_p.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">LA PURGA</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:00</button>
                                          <button type="button" class="btn btn-outline-danger">19:40</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>




                        </div>
                        <div class="tab-pane fade my-4" id="pills-viernes" role="tabpanel"
                          aria-labelledby="pills-viernes-tab">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.ecartelera.com/carteles-series/600/681/007_p.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">LA PURGA</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:10</button>
                                          <button type="button" class="btn btn-outline-danger">19:30</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane fade my-4" id="pills-sab" role="tabpanel" aria-labelledby="pills-sab-tab">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.ecartelera.com/carteles-series/600/681/007_p.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">LA PURGA</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:50</button>
                                          <button type="button" class="btn btn-outline-danger">20:00</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane fade my-4" id="pills-dom" role="tabpanel" aria-labelledby="pills-dom-tab">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.ecartelera.com/carteles-series/600/681/007_p.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">LA PURGA</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 18 años"><button class="btn btn-warning btn-sm" disabled>B12</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">20:00</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>


                    </div>




                    <div class="tab-pane fade" id="pills-Pelicula2" role="tabpanel"
                      aria-labelledby="pills-Pelicula2-tab">


                      <div class="tab-content" id="pills-tabContent">
                        <ul class="nav justify-content-center" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-lunes2-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-lunes2" type="button" role="tab" aria-controls="pills-lunes2"
                              aria-selected="true">LUN. 26.7.2021</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-martes2-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-martes2" type="button" role="tab" aria-controls="pills-martes2"
                              aria-selected="false">MAR. 27.7.2021.</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-miercoles2-tab"
                              data-bs-toggle="pill" data-bs-target="#pills-miercoles2" type="button" role="tab"
                              aria-controls="pills-miercoles2" aria-selected="false">MIÉ. 28.7.2021</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-jueves2-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-jueves2" type="button" role="tab" aria-controls="pills-jueves2"
                              aria-selected="true">JUE. 29.7.2021</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-viernes2-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-viernes2" type="button" role="tab" aria-controls="pills-viernes2"
                              aria-selected="false">VIE. 30.7.2021.</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-sab2-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-sab2" type="button" role="tab" aria-controls="pills-sab2"
                              aria-selected="false">SÁB. 31.7.2021</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="btn btn-outline-secondary me-1" id="pills-dom2-tab" data-bs-toggle="pill"
                              data-bs-target="#pills-dom2" type="button" role="tab" aria-controls="pills-dom2"
                              aria-selected="false">DOM. 01.8.2021</button>
                          </li>
                        </ul>

                        <div class="tab-pane fade my-4" id="pills-lunes2" role="tabpanel"
                          aria-labelledby="pills-lunes2-tab">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.portaldetuciudad.com/imagenes/cartelera/cartel5672.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">SUICIDE SQUAD</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 15 años"><button class="btn btn-warning btn-sm" disabled>C</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:10</button>
                                          <button type="button" class="btn btn-outline-danger">19:30</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade show active my-4" id="pills-martes2" role="tabpanel"
                          aria-labelledby="pills-martes2-tab">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.portaldetuciudad.com/imagenes/cartelera/cartel5672.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">SUICIDE SQUAD</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 15 años"><button class="btn btn-warning btn-sm" disabled>C</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:20</button>
                                          <button type="button" class="btn btn-outline-danger">19:40</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade my-4" id="pills-miercoles2" role="tabpanel"
                          aria-labelledby="pills-miercoles2-tab">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.portaldetuciudad.com/imagenes/cartelera/cartel5672.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">SUICIDE SQUAD</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 15 años"><button class="btn btn-warning btn-sm" disabled>C</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:10</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>



                        </div>
                        <div class="tab-pane fade my-4" id="pills-jueves2" role="tabpanel"
                          aria-labelledby="pills-jueves2-tab">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.portaldetuciudad.com/imagenes/cartelera/cartel5672.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">SUICIDE SQUAD</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 15 años"><button class="btn btn-warning btn-sm" disabled>C</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:00</button>
                                          <button type="button" class="btn btn-outline-danger">19:40</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>




                        </div>
                        <div class="tab-pane fade my-4" id="pills-viernes2" role="tabpanel"
                          aria-labelledby="pills-viernes2-tab">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.portaldetuciudad.com/imagenes/cartelera/cartel5672.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">SUICIDE SQUAD</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 15 años"><button class="btn btn-warning btn-sm" disabled>C</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:10</button>
                                          <button type="button" class="btn btn-outline-danger">19:30</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane fade my-4" id="pills-sab2" role="tabpanel"
                          aria-labelledby="pills-sab2-tab">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.portaldetuciudad.com/imagenes/cartelera/cartel5672.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">SUICIDE SQUAD</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 15 años"><button class="btn btn-warning btn-sm" disabled>C</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">16:50</button>
                                          <button type="button" class="btn btn-outline-danger">20:00</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane fade my-4" id="pills-dom2" role="tabpanel"
                          aria-labelledby="pills-dom2-tab">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card mb-3 border-0">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="https://www.portaldetuciudad.com/imagenes/cartelera/cartel5672.jpg" class="rounded mx-auto d-block"
                                      width="50%" alt="...">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">SUICIDE SQUAD</h5>
                                      <div class="d-grid gap-2 d-md-block my-3">
                                <abbr title="mayores de 15 años"><button class="btn btn-warning btn-sm" disabled>C</button></abbr>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>135 min</button>
                                      </div>
                                      <!--tarjeta interna-->
                                      <div class="card text-dark bg-light mb-3" style="max-width: 35rem;">
                                        <div class="card-header">
                                          <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-secondary btn-sm" disabled>2D</button>
                                            <button class="btn btn-secondary btn-sm" disabled>Sub</button>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h6>
                                            <p class="text-secondary">*Los horarios aquí expuestos representan el
                                              inicio
                                              de cada función.
                                            </p>
                                          </h6>
                                          <button type="button" class="btn btn-outline-danger">20:00</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>



                    </div>

                  </div>



                </div>
              </div>
            </div>
          </div>
        </div>
      </div>





    </div>

    <!--FINAL DEL CUERPO-->
    <footer>
      <div class="container-fluid">
        <div class="row bg-light">
          <div class="col-md-4">
            <div class="text-center">
              <img class="me-1 mb-2" src="/assets/img/logos/cinematrix.svg" width="175" alt="">
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
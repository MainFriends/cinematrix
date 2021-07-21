<?php
require_once "inc/config.php";

        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $id = $_GET['id'];
        $query = "SELECT * FROM PELICULA WHERE ID_PELICULA ='$id'";
        $stm = $conexion->prepare($query);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);
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
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img class="me-1 mb-2" src="assets/img/logos/cinematrix.svg" width="70" alt="">
                <span class="me-2 fs-3 fw-bold mb-0">Cinematrix</span>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                  <a class="btn btn-danger dropdown" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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

          <!-- Cuerpo-->
          <div class="container">
            <div class="row my-4">
              <div class="col-md-3">
                <div class="row">
                <img src="<?php echo $data['PORTADA'] ?>" alt="">
                </div>
                <div class="row py-3">
                  <h5 class="border-bottom text-danger">TITULO ORIGINAL</h5>
                  <p><?php echo $data['TITULO'] ?></p>
                </div>
                <div class="row">
                  <h5 class="border-bottom text-danger">SINOPSIS  </h5>
                  <p><?php echo $data['SINOPSIS'] ?></p>
                </div>
              </div>
              <div class="col-md-9">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                  <label class="btn btn-outline-warning text-dark rounded-start" for="btnradio1">MAR. 20 JUL. 2021</label>
                
                  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                  <label class="btn btn-outline-warning text-dark" for="btnradio1">MIÉ. 21 JUL. 2021</label>
                
                  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                  <label class="btn btn-outline-warning rounded-end text-dark" for="btnradio1">JUE. 22 JUL. 2021</label>
                </div>
                <div class="row my-4">
                  <div class="card">
                    <div class="card-header fw-bold">Cinematrix - Multiplaza Tegucigalpa
                      <span>
                        <div class="mx-2 badge bg-secondary text-wrap" style="width: 6rem;">
                          2D
                        </div>
                        <div class="badge bg-secondary text-wrap" style="width: 6rem;">
                          DOB
                        </div>
                      </span>
                    </div>
                    <div class="card-body">
                      <p class="card-text fw-lighter ">*Los horarios aquí expuestos representan el inicio de cada función</p>
                      <a href="#" class=" my-0 btn btn-outline-danger btn-sm">2:45 PM</a>
                      <a href="#" class=" mx-3 btn btn-outline-danger btn-sm">4:05 PM</a>
                    </div>
                  </div>
                </div>
                <div class="row my-4">
                  <div class="card">
                    <div class="card-header fw-bold">Cinematrix - Citymall Tegucigalpa
                      <span>
                        <div class="mx-2 badge bg-secondary text-wrap" style="width: 6rem;">
                          2D
                        </div>
                        <div class="badge bg-secondary text-wrap" style="width: 6rem;">
                          DOB
                        </div>
                      </span>
                    </div>
                    <div class="card-body">
                      <p class="card-text fw-lighter ">*Los horarios aquí expuestos representan el inicio de cada función</p>
                      <a href="#" class="btn btn-outline-danger btn-sm">10:50 AM</a>
                      <a href="#" class="mx-3 btn btn-outline-danger btn-sm">7:35 PM</a>
                      <a href="#" class="btn btn-outline-danger btn-sm">9:10 PM</a>
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
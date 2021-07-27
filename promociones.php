<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promociones - Cinematrix</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
  <div class="container-fluid bg-light">
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
              <a class="nav-link" href="promociones.php" tabindex="-1" aria-disabled="true">PROMOCIONES</a>
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
    <div class="card" style="background-color: #E3E4E5;">
      <div class="card-body">
        <h5 class="card-title">PROMOCIONES DISPONIBLES</h5>
        <h6 class="card-subtitle mb-2 text-muted">TODAS LAS PROMOCIONES ESTÁN SUJETAS A TÉRMINOS Y CONDICIONES</h6>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="my-4 col-md-12">
          <!-- Nav tabs -->
          <ul  class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-danger active btn btn-outline-danger  me-1" id="pills-taquilla-tab" data-bs-toggle="pill"
                data-bs-target="#pills-taquilla" type="button" role="tab" aria-controls="pills-taquilla"
                aria-selected="true">Taquilla</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-danger btn btn-outline-danger" id="pills-dulce-tab" data-bs-toggle="pill" data-bs-target="#pills-dulce"
                type="button" role="tab" aria-controls="pills-dulce" aria-selected="false">Dulcería</button>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-taquilla" role="tabpanel"
              aria-labelledby="pills-taquilla-tab">
              <div class="row">
                <div class=" my-2 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <img src="assets/img/promociones/terceraEdad.jpg" class="rounded float-start" width="100%"
                            height="100%" alt="">
                        </div>
                        <div class="col-md-6">
                          <div class="card-title">
                            <h5>Descuento Tercera Edad</h5>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Comienza: </p>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Termina: </p>
                            
                            <div class="d-grid gap-2 ">
                              <a class="btn btn-danger btn-block" href="detallePromo.html" ><button class="btn btn-danger btn-block" type="button">VER DETALLE</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" my-2 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <img src="assets/img/promociones/2x1.jpg" class="rounded float-start" width="100%"
                            height="100%" alt="">
                        </div>
                        <div class="col-md-6">
                          <div class="card-title">
                            <h5>Promoción 2x1</h5>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Comienza: </p>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Termina: </p>
                            <div class="d-grid gap-2">
                              <a class="btn btn-danger btn-block" href="detallePromo.html"><button class="btn btn-danger" type="button" >VER DETALLE</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" my-2 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <img src="assets/img/promociones/mitadprecio.jpeg" class="rounded float-start" width="100%"
                            height="100%" alt="">
                        </div>
                        <div class="col-md-6">
                          <div class="card-title">
                            <h5>M&M Mitad de Precio</h5>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Comienza: </p>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Termina: </p>
                            <div class="d-grid gap-2">
                              <a class="btn btn-danger btn-block" href="detallePromo.html"> <button class="btn btn-danger" type="button">VER DETALLE</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" my-2 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <img src="assets/img/promociones/familiar.jpeg" class="rounded float-start" width="100%"
                            height="100%" alt="">
                        </div>
                        <div class="col-md-6">
                          <div class="card-title">
                            <h5>Familiar</h5>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Comienza: </p>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Termina: </p>
                            <div class="d-grid gap-2">
                              <a class="btn btn-danger btn-block" href="detallePromo.html"> <button class="btn btn-danger" type="button">VER DETALLE</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!--Panel dulcería-->
            <div class="tab-pane fade" id="pills-dulce" role="tabpanel" aria-labelledby="pills-dulce-tab">
              <div class="row">
                <div class="my-2 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <img src="assets/img/promociones/cineindividual.jpg" class="rounded float-start" width="100%"
                            height="100%" alt="">
                        </div>
                        <div class="col-md-6">
                          <div class="card-title">
                            <h5>Cinepack Individual</h5>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Comienza: </p>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Termina: </p>
                            <div class="d-grid gap-2">
                              <a class="btn btn-danger btn-block" href="detallePromo.html"> <button class="btn btn-danger" type="button">VER DETALLE</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="my-2 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <img src="assets/img/promociones/2x1.jpg" class="rounded float-start" width="100%" alt="">
                        </div>
                        <div class="col-md-6">
                          <div class="card-title">
                            <h5>Promoción 2x1</h5>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Comienza: </p>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Termina: </p>
                            <div class="d-grid gap-2">
                              <a  class="btn btn-danger btn-block" href="detallePromo.html"> <button class="btn btn-danger" type="button">VER DETALLE</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" my-2 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <img src="assets/img/promociones/mitadprecio.jpeg" class="rounded float-start" width="100%"
                            height="100%" alt="">
                        </div>
                        <div class="col-md-6">
                          <div class="card-title">
                            <h5>M&M Mitad de Precio</h5>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Comienza: </p>
                            <!--relojito-->
                            <p><i class="bi bi-clock"></i> Termina: </p>
                            <div class="d-grid gap-2">
                              <a class="btn btn-danger btn-block" href="detallePromo.html"> <button class="btn btn-danger" type="button">VER DETALLE</button></a>
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
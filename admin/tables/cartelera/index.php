<?php
  session_start();
  $userSession = $_SESSION['usuario'];
  $_SESSION['pag'] = 'admin';
  require_once "../../../inc/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Diego Velázquez">
    <meta name="description" content="Tablero con Bootstrap 4 - Templune">
    <title>Cinematrix - Panel de Administración</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

     <!-- bootstrap5 y main.css -->
    <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- dataTables css básico-->
    <link rel="stylesheet" type="text/css" href="../dataTables/datatables.min.css">

    <!-- dataTables estilo bootstrap 5 CSS-->
    <link rel="stylesheet" type="text/css" href="../dataTables/DataTables-1.10.25/css/dataTables.bootstrap5.min.css">

    <link href="../../../assets/css/style-panel.css" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/151b334714.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <div class="container-fluid">
    <div class="d-flex" id="content-wrapper">

      <!-- Sidebar -->
      <div id="sidebar-container" class="bg-light border-right">
        <div class="logo">
        <div class="row">
          <div class="col-md-4">
            <img class="me-2" src="../../../assets/img/logos/cinematrix.svg" width="70" alt="">
          </div>
          <div class="col-md-8" style="margin: 0px; padding: 0px;">
          <span class=" fs-2 mb-3 fw-bold">Cinematrix</span>
          </div>
        </div>  
        </div>
        <div class="menu list-group-flush">
        <a href="../../graph/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0 fw-bold ms-1"><i class="fas fa-user-friends me-1"></i> Gráficos</a>
          <a href="../usuarios/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0 fw-bold ms-1"><i class="fas fa-user-friends me-1"></i> Usuarios</a>
          <a href="../administradores/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0 fw-bold ms-1"><i class="fas fa-user-shield me-1"></i> Administradores</a>
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button bg-light collapsed fw-bold text-danger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <i class="icon ion-ios-create lead me-2"></i> Tablas
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body bg-light">
                    <a class="dropdown-item rounded fw-ligth" aria-current="page" href="../pelicula/index.php">Películas</a>
                    <a class="dropdown-item rounded fw-ligth active" href="../cartelera/index.php">Carteleras</a>
                    <a class="dropdown-item rounded fw-ligth" href="../sala/index.php">Salas</a>
                    <a class="dropdown-item rounded fw-ligth" href="../asiento/index.php">Asientos</a>
                    <a class="dropdown-item rounded fw-ligth" href="../promocion/index.php">Promociones</a>
                    <a class="dropdown-item rounded fw-ligth" href="../progPromo/index.php">Programa de promociones</a>
                    <a class="dropdown-item rounded fw-ligth" href="../boleto/index.php">Boletos</a>
                    <a class="dropdown-item rounded fw-ligth" href="../combo/index.php">Combos</a>
                  </div>
                </div>
              </div>        
            </div>
            <a href="../facturas/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0 fw-bold ms-1"><i class="fas fa-money-check-alt me-1"></i> Ventas</a>
        </div>
      </div>

      <!-- NavBar -->
      <div id="page-content-wrapper" class="w-100 bg-light-blue">
          <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-danger btn-lg " id="menu-toggle"><i class="fas fa-bars"></i></button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link text-dark" href="../../../index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link text-dark dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                        $userApellido = $_SESSION["apellido"];
                        echo "$userSession $userApellido";
                      ?> 
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../../../account.php"><i class='fas fa-user-edit me-2'></i>Editar perfil</a></li>
                    <li><a class="dropdown-item" href="../../../inc/logout.php"><i class='fas fa-sign-out-alt me-2'></i>Cerrar sesión</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>

      <!-- Visualizar Tabla -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card text-left">
            <div class="card-header">
              Gestión de contenido
            </div>
            <div class="card-body">
              <button class="btn btn-danger rounded-pill" id="addCartelera"><i class="fas fa-plus me-2"></i>Agregar nuevo</button>
              <hr>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="tablaCartelera" style="width:100%">
                    <thead class="text-center">
                        <tr>
                          <th>ID</th>
                          <th>PELICULA</th>
                          <th>HORA INICIO</th>
                          <th>HORA FIN</th>
                          <th>SALA</th>
                          <th>IDIOMA</th>
                          <th>FORMATO</th>
                          <th>FECHA</th>
                          <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center"> 
                    </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer text-muted">
              Cinematrix
            </div>
          </div>
        </div>
      </div>
  </div>

   <!--Modal Cartelera -->
 <div class="modal fade" id="modalCartelera" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cartelera</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="frmCartelera">
                <div class="container">
                    <div class="row">
                      <div class="col-md-8">
                          <label class="form-label">Pelicula</label>
                          <select id="pelicula" class="form-select" required>
                              <option value="">-</option>
                              <?php
                                  mostrarPeliculas();
                              ?>
                          </select>
                      </div>
                      <div class="col-md-4">
                          <label class="form-label">Sala</label>
                          <select id="sala" class="form-select mb-2" required>
                              <option value="">-</option>
                              <?php
                                  mostrarSalas();
                              ?>
                          </select>
                      </div>
                      <div class="col-md-4 mb-2">
                          <label class="form-label">Hora inicio</label>
                          <input class="form-control input-sm" type="time" id="horaInicio" required>
                      </div>
                      <div class="col-md-4 mb-2">
                          <label class="form-label">Hora fin</label>
                          <input class="form-control input-sm" type="time" id="horaFin" required>
                      </div>
                      <div class="col-md-4">
                          <label class="form-label">Idioma</label>
                          <select id="idioma" class="form-select mb-2" required>
                              <option value="">-</option>
                              <?php
                                  mostrarIdiomas();
                              ?>
                          </select>
                      </div>
                      <div class="col-md-3 mb-2">
                          <label class="form-label">Formato</label>
                          <select id="formato" class="form-select mb-2" required>
                              <option value="">-</option>
                              <?php
                                  mostrarFormatos();
                              ?>
                          </select>
                      </div>
                      <div class="col-md-5 mb-2">
                          <label class="form-label">Fecha</label>
                          <input class="form-control input-sm" type="date" id="fecha" required>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" id="btnListo" class="btn btn-dark">Listo</button>
                      </div>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

      <!-- Modal eliminar -->
  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"  style="border: none;">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p>¿Esta seguro que desea eliminar esta cartelera? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnSi" data-bs-dismiss="modal">Sí</button>
        <button type="button" class="btn btn-primary" id="btnCancelar">Cancelar</button>
      </div>
    </div>
  </div>
</div>

  <!-- JQuery, Bundle.JS, Bootstrap JS -->
  <script src="../../../assets/js/jquery.js"></script>
  <script src="../../../assets/js/bootstrap.bundle.min.js"></script>

  <!-- dataTables JS -->
  <script type="text/javascript" src="../dataTables/datatables.min.js"></script>
  <script type="text/javascript" src="main.js"></script>

  </body> 
</html>

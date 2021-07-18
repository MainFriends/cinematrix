<?php
  session_start();
  $userSession = $_SESSION['usuario'];
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

     <!-- bootstrap5 y main.css -->
    <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- dataTables css básico-->
    <link rel="stylesheet" type="text/css" href="../dataTables/datatables.min.css">

    <!-- dataTables estilo bootstrap 5 CSS-->
    <link rel="stylesheet" type="text/css" href="../dataTables/DataTables-1.10.25/css/dataTables.bootstrap5.min.css">

    <link href="../../../assets/css/style-panel.css" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
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
          <span class=" fs-2 mb-3">Cinematrix</span>
          </div>
        </div>  
          
        </div>
        <div class="menu list-group-flush">
          <a href="../usuarios/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0"><i class="icon ion-md-people lead me-2"></i> Usuarios</a>
          <a href="../pelicula/index.php" class="btn list-group-item list-group-item-action bg-light p-3 border-0"><i class="icon ion-md-grid lead me-2"></i> Tablas</a>
        </div>
      </div>
      <!-- NavBar -->
      <div id="page-content-wrapper" class="w-100 bg-light-blue">
          <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-dark" id="menu-toggle">Mostrar/Esconder menú</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link text-dark" href="#">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link text-dark dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                        $userApellido = $_SESSION["apellido"];
                        echo "$userSession $userApellido";
                      ?> 
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../../../inc/logout.php">Cerrar sesión</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>

        <!-- Encabezado -->
        <nav id="content">
          <section class="py-3  border-bottom">
                <div class="row">
                    <div class="col">
                        <h1 class="fw-bold mb-0">Bienvenido,
                          <?php
                            echo "$userSession"
                          ?> 
                        </h1>
                    </div>
                </div>
            </section>
        </nav>

      <!-- Visualizar Tabla -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card text-left">
            <div class="card-header">
              Gestión de tablas
            </div>
            <div class="card-body">
              <span class="btn btn-primary" id="addAsiento"><i class="icon ion-md-add me-2"></i>Agregar nuevo</span>
              <span class="dropdown">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="icon ion-md-list me-2"></i>Lista de tablas
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="../pelicula/index.php"><i class="icon ion-md-film me-2"></i>Películas</a></li>
                  <li><a class="dropdown-item" href="../cartelera/index.php"><i class="icon ion-md-star me-2"></i>Carteleras</a></li>
                  <li><a class="dropdown-item" href="../sala/index.php"><i class="icon ion-md-videocam me-2"></i>Salas</a></li>
                  <li><a class="dropdown-item" href="../asiento/index.php"><i class="icon ion-md-contacts me-2"></i>Asientos</a></li>
                  <li><a class="dropdown-item" href="../promocion/index.php"><i class="icon ion-md-pricetag me-2"></i>Promociones</a></li>
                  <li><a class="dropdown-item" href="../progPromo/index.php"><i class="icon ion-md-calendar me-2"></i>Programa de promociones</a></li>
                </ul>
              </span>
              <hr>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="tablaAsiento" style="width:100%">
                    <thead class="text-center">
                        <tr>
                          <th>ID</th>
                          <th>NOMBRE ASIENTO</th>
                          <th>ID SALA</th>
                          <th>ID ESTADO</th>
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

   <!--Modal Asiento -->
 <div class="modal fade" id="modalAsiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Asiento</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="frmAsiento">
                <div class="container">
                    <div class="row">
                      <div class="col-md-6">
                          <label class="form-label">Nombre de asiento</label>
                          <input class="form-control input-sm" type="text" id="numAsiento" required>
                      </div>
                      <div class="col-md-6 mb-2">
                          <label class="form-label">Sala</label>
                          <select id="sala" class="form-select mb-2" required>
                              <option value="">-</option>
                              <?php
                                  mostrarSalas();
                              ?>
                          </select>
                      </div>
                      <div class="col-md-6 mb-2">
                          <label class="form-label">Estado</label>
                          <select id="estado" class="form-select mb-2" required>
                              <option value="">-</option>
                              <?php
                                  mostrarEstados();
                              ?>
                          </select>
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

  <!-- JQuery, Bundle.JS, Bootstrap JS -->
  <script src="../../../assets/js/jquery.js"></script>
  <script src="../../../assets/js/bootstrap.bundle.min.js"></script>

  <!-- dataTables JS -->
  <script type="text/javascript" src="../dataTables/datatables.min.js"></script>
  <script type="text/javascript" src="main.js"></script>

  </body> 
</html>

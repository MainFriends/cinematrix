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
          <a href="../usuarios/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0 fw-bold ms-1"><i class="fas fa-user-friends me-1"></i> Usuarios</a>
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button bg-light collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <i class="icon ion-ios-create lead me-2"></i> Tablas
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body bg-light">
                    <a class="dropdown-item rounded fw-ligth active" aria-current="page" href="../pelicula/index.php">Películas</a>
                    <a class="dropdown-item rounded fw-ligth" href="../cartelera/index.php">Carteleras</a>
                    <a class="dropdown-item rounded fw-ligth" href="../sala/index.php">Salas</a>
                    <a class="dropdown-item rounded fw-ligth" href="../asiento/index.php">Asientos</a>
                    <a class="dropdown-item rounded fw-ligth" href="../promocion/index.php">Promociones</a>
                    <a class="dropdown-item rounded fw-ligth" href="../progPromo/index.php">Programa de promociones</a>
                  </div>
                </div>
              </div>        
            </div>
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
                    <li><a class="dropdown-item" href="../../../account.php">Mi Perfil</a></li>
                    <li><a class="dropdown-item" href="../../../inc/logout.php">Cerrar sesión</a></li>
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
              <button class="btn btn-danger rounded-pill" id="addPelicula"><i class="fas fa-plus me-2"></i>Agregar nuevo</button>
              <hr>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="tablaPelicula" style="width:100%">
                    <thead class="text-center">
                        <tr>
                          <th>ID</th>
                          <th>TITULO</th>
                          <th>SINOPSIS</th>
                          <th>DURACION</th>
                          <th>AÑO</th>
                          <th>ID GENERO</th>
                          <th>ID CLASIFICACION</th>
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

   <!--Modal Pelicula -->
 <div class="modal fade" id="modalPelicula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-light">
              <h5 class="modal-title fw-bold" id="exampleModalLabel">Película</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
              <form id="frmPelicula">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 mb-2">
                            <label class="form-input">Título de la película</label>
                            <input class="form-control input-sm" type="text" id="titulo">
                        </div>
                        <div class="col-md-5">
                            <label class="form-input">Género</label>
                            <select id="genero" class="form-select" required>
                                <option value="">-</option>
                                <?php
                                    mostrarGeneros();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-input">Clasificación</label>
                            <select id="clasificacion" class="form-select mb-2" required>
                                <option value="">-</option>
                                <?php
                                    mostrarClasificacion();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-9 mb-2">
                            <label class="form-input">Sinopsis</label>
                            <textarea class="form-control" id="sinopsis" rows="3"></textarea>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-input">Duración</label>
                            <input class="form-control input-sm" type="text" id="duracion" placeholder="hh:mm:ss">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-input">Año</label>
                            <input type="number" id="año" class="form-control" min="1900" max="2099" step="1" value="2016" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-input">Estado</label>
                            <select id="estado" class="form-select mb-2" required>
                                <option value="">-</option>
                                <?php
                                    mostrarEstados();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-input">URL Portada</label><br/>
                            <input class="form-control input-sm" id="portada" type="Text">
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
        <p>¿Esta seguro que desea eliminar esta película? </p>
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

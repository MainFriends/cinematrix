<?php
  session_start();
  $userSession = $_SESSION['usuario'];
  $_SESSION['pag'] = 'admin';
  require_once "../../inc/config.php";
  $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $query = "SELECT DISTINCT DETALLE.ID_FACTURA, TITULO
    FROM FACTURA, DETALLE, PELICULA, CARTELERA
    WHERE FACTURA.ID_FACTURA = DETALLE.ID_FACTURA
    AND DETALLE.ID_CARTELERA = CARTELERA.ID_CARTELERA
    AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
    AND CARTELERA.ID_PELICULA = 7";//venom
    $stm = $conexion->prepare($query);
    $stm->execute();
    $facturas = $stm->fetchAll(PDO::FETCH_ASSOC);
    $countVenom = $stm->rowCount();

    $query = "SELECT DISTINCT DETALLE.ID_FACTURA, TITULO
    FROM FACTURA, DETALLE, PELICULA, CARTELERA
    WHERE FACTURA.ID_FACTURA = DETALLE.ID_FACTURA
    AND DETALLE.ID_CARTELERA = CARTELERA.ID_CARTELERA
    AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
    AND CARTELERA.ID_PELICULA = 1";//Space Jam
    $stm = $conexion->prepare($query);
    $stm->execute();
    $facturas = $stm->fetchAll(PDO::FETCH_ASSOC);
    $countSpace = $stm->rowCount();

    $query = "SELECT DISTINCT DETALLE.ID_FACTURA, TITULO
    FROM FACTURA, DETALLE, PELICULA, CARTELERA
    WHERE FACTURA.ID_FACTURA = DETALLE.ID_FACTURA
    AND DETALLE.ID_CARTELERA = CARTELERA.ID_CARTELERA
    AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
    AND CARTELERA.ID_PELICULA = 2";//Black Widow
    $stm = $conexion->prepare($query);
    $stm->execute();
    $facturas = $stm->fetchAll(PDO::FETCH_ASSOC);
    $countBlack = $stm->rowCount();

    $query = "SELECT DISTINCT DETALLE.ID_FACTURA, TITULO
    FROM FACTURA, DETALLE, PELICULA, CARTELERA
    WHERE FACTURA.ID_FACTURA = DETALLE.ID_FACTURA
    AND DETALLE.ID_CARTELERA = CARTELERA.ID_CARTELERA
    AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
    AND CARTELERA.ID_PELICULA = 6";//Spiderman
    $stm = $conexion->prepare($query);
    $stm->execute();
    $facturas = $stm->fetchAll(PDO::FETCH_ASSOC);
    $countSpider = $stm->rowCount();

    $query = "SELECT DISTINCT DETALLE.ID_FACTURA, TITULO
    FROM FACTURA, DETALLE, PELICULA, CARTELERA
    WHERE FACTURA.ID_FACTURA = DETALLE.ID_FACTURA
    AND DETALLE.ID_CARTELERA = CARTELERA.ID_CARTELERA
    AND PELICULA.ID_PELICULA = CARTELERA.ID_PELICULA
    AND CARTELERA.ID_PELICULA = 9";//Jungle Cruise
    $stm = $conexion->prepare($query);
    $stm->execute();
    $facturas = $stm->fetchAll(PDO::FETCH_ASSOC);
    $countJungle = $stm->rowCount();

    //GRAFICO USUARIOS CON MAS COMPRAS
    $query = "SELECT COUNT(FACTURA.ID_USUARIO) COMPRAS, CONCAT(NOMBRE, ' ', APELLIDO) NOMBRE FROM FACTURA, USUARIO
    WHERE FACTURA.ID_USUARIO = USUARIO.ID_USUARIO
    AND FACTURA.ID_USUARIO = 1";//Primer usuario
    $stm = $conexion->prepare($query);
    $stm->execute();
    $user1 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(FACTURA.ID_USUARIO) COMPRAS, CONCAT(NOMBRE, ' ', APELLIDO) NOMBRE FROM FACTURA, USUARIO
    WHERE FACTURA.ID_USUARIO = USUARIO.ID_USUARIO
    AND FACTURA.ID_USUARIO = 2";//Segundo usuario
    $stm = $conexion->prepare($query);
    $stm->execute();
    $user2 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(FACTURA.ID_USUARIO) COMPRAS, CONCAT(NOMBRE, ' ', APELLIDO) NOMBRE FROM FACTURA, USUARIO
    WHERE FACTURA.ID_USUARIO = USUARIO.ID_USUARIO
    AND FACTURA.ID_USUARIO = 3";//tercer usuario
    $stm = $conexion->prepare($query);
    $stm->execute();
    $user3 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(FACTURA.ID_USUARIO) COMPRAS, CONCAT(NOMBRE, ' ', APELLIDO) NOMBRE FROM FACTURA, USUARIO
    WHERE FACTURA.ID_USUARIO = USUARIO.ID_USUARIO
    AND FACTURA.ID_USUARIO = 4";//Cuarto usuario
    $stm = $conexion->prepare($query);
    $stm->execute();
    $user4 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(FACTURA.ID_USUARIO) COMPRAS, CONCAT(NOMBRE, ' ', APELLIDO) NOMBRE FROM FACTURA, USUARIO
    WHERE FACTURA.ID_USUARIO = USUARIO.ID_USUARIO
    AND FACTURA.ID_USUARIO = 5";//Quinto usuario
    $stm = $conexion->prepare($query);
    $stm->execute();
    $user5 = $stm->fetch(PDO::FETCH_ASSOC);

    //ALIMENTOS Y BEBIDAS MAS COMPRADOS
    $query = "SELECT COUNT(DETALLE.ID_COMBO) COMPRA, NOMBRE FROM DETALLE, COMBO
    WHERE DETALLE.ID_COMBO = COMBO.ID_COMBO
    AND DETALLE.ID_COMBO = 1";//Primer combo
    $stm = $conexion->prepare($query);
    $stm->execute();
    $combo1 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(DETALLE.ID_COMBO) COMPRA, NOMBRE FROM DETALLE, COMBO
    WHERE DETALLE.ID_COMBO = COMBO.ID_COMBO
    AND DETALLE.ID_COMBO = 2";//segundo combo
    $stm = $conexion->prepare($query);
    $stm->execute();
    $combo2 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(DETALLE.ID_COMBO) COMPRA, NOMBRE FROM DETALLE, COMBO
    WHERE DETALLE.ID_COMBO = COMBO.ID_COMBO
    AND DETALLE.ID_COMBO = 3";//tercer combo
    $stm = $conexion->prepare($query);
    $stm->execute();
    $combo3 = $stm->fetch(PDO::FETCH_ASSOC);
    
    $query = "SELECT COUNT(DETALLE.ID_COMBO) COMPRA, NOMBRE FROM DETALLE, COMBO
    WHERE DETALLE.ID_COMBO = COMBO.ID_COMBO
    AND DETALLE.ID_COMBO = 4";//cuarto combo
    $stm = $conexion->prepare($query);
    $stm->execute();
    $combo4 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(DETALLE.ID_COMBO) COMPRA, NOMBRE FROM DETALLE, COMBO
    WHERE DETALLE.ID_COMBO = COMBO.ID_COMBO
    AND DETALLE.ID_COMBO = 5";//quinto combo
    $stm = $conexion->prepare($query);
    $stm->execute();
    $combo5 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(DETALLE.ID_COMBO) COMPRA, NOMBRE FROM DETALLE, COMBO
    WHERE DETALLE.ID_COMBO = COMBO.ID_COMBO
    AND DETALLE.ID_COMBO = 6";//sexto combo
    $stm = $conexion->prepare($query);
    $stm->execute();
    $combo6 = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(DETALLE.ID_COMBO) COMPRA, NOMBRE FROM DETALLE, COMBO
    WHERE DETALLE.ID_COMBO = COMBO.ID_COMBO
    AND DETALLE.ID_COMBO = 7";//septimo combo
    $stm = $conexion->prepare($query);
    $stm->execute();
    $combo7 = $stm->fetch(PDO::FETCH_ASSOC);

    //VENTAS SEMANALES
    $query = "SELECT SUM(TOTAL) TOTAL FROM FACTURA
    WHERE FECHA LIKE '2021-08-15%'";
    $stm = $conexion->prepare($query);
    $stm->execute();
    $domingo = $stm->fetch(PDO::FETCH_ASSOC);
    
    $query = "SELECT SUM(TOTAL) TOTAL FROM FACTURA
    WHERE FECHA LIKE '2021-08-16%'";
    $stm = $conexion->prepare($query);
    $stm->execute();
    $lunes = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT SUM(TOTAL) TOTAL FROM FACTURA
    WHERE FECHA LIKE '2021-08-17%'";
    $stm = $conexion->prepare($query);
    $stm->execute();
    $martes = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT SUM(TOTAL) TOTAL FROM FACTURA
    WHERE FECHA LIKE '2021-08-18%'";
    $stm = $conexion->prepare($query);
    $stm->execute();
    $miercoles = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT SUM(TOTAL) TOTAL FROM FACTURA
    WHERE FECHA LIKE '2021-08-19%'";
    $stm = $conexion->prepare($query);
    $stm->execute();
    $jueves = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT SUM(TOTAL) TOTAL FROM FACTURA
    WHERE FECHA LIKE '2021-08-20%'";
    $stm = $conexion->prepare($query);
    $stm->execute();
    $viernes = $stm->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT SUM(TOTAL) TOTAL FROM FACTURA
    WHERE FECHA LIKE '2021-08-21%'";
    $stm = $conexion->prepare($query);
    $stm->execute();
    $sabado = $stm->fetch(PDO::FETCH_ASSOC);
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
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

    <script src="../../assets/js/Chart.js"></script>

    <link href="../../assets/css/style-panel.css" rel="stylesheet">
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
            <img class="me-2" src="../../assets/img/logos/cinematrix.svg" width="70" alt="">
          </div>
          <div class="col-md-8" style="margin: 0px; padding: 0px;">
          <span class=" fs-2 mb-3 fw-bold">Cinematrix</span>
          </div>
        </div>  
        </div>
        <div class="menu list-group-flush">
        <a href="../tables/usuarios/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0 fw-bold ms-1 text-danger"><i class="fas fa-user-friends me-1"></i> Gráficos</a>
        <a href="../tables/usuarios/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0 fw-bold ms-1"><i class="fas fa-user-friends me-1"></i> Usuarios</a>
          <a href="../tables/administradores/index.php" class="list-group-item list-group-item-action bg-light p-3 border-0 fw-bold ms-1"><i class="fas fa-user-shield me-1"></i> Administradores</a>
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button bg-light collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <i class="icon ion-ios-create lead me-2"></i> Tablas
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body bg-light">
                    <a class="dropdown-item rounded fw-ligth" aria-current="page" href="../tables/pelicula/index.php">Películas</a>
                    <a class="dropdown-item rounded fw-ligth" href="../tables/cartelera/index.php">Carteleras</a>
                    <a class="dropdown-item rounded fw-ligth" href="../tables/sala/index.php">Salas</a>
                    <a class="dropdown-item rounded fw-ligth" href="../tables/asiento/index.php">Asientos</a>
                    <a class="dropdown-item rounded fw-ligth" href="../tables/promocion/index.php">Promociones</a>
                    <a class="dropdown-item rounded fw-ligth" href="../tables/progPromo/index.php">Programa de promociones</a>
                    <a class="dropdown-item rounded fw-ligth" href="../tables/boleto/index.php">Boletos</a>
                    <a class="dropdown-item rounded fw-ligth" href="../tables/combo/index.php">Combos</a>
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
                  <a class="nav-link text-dark" href="../../index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link text-dark dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                        $userApellido = $_SESSION["apellido"];
                        echo "$userSession $userApellido";
                      ?> 
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../../account.php"><i class='fas fa-user-edit me-2'></i>Editar perfil</a></li>
                    <li><a class="dropdown-item" href="../../inc/logout.php"><i class='fas fa-sign-out-alt me-2'></i>Cerrar sesión</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>

          <div class="container">
            <div class="row">
              <div class="col-md-4 text-center">
                <h5 class="fw-bold">Películas más vendidas</h5>
                <div id="canvas-holder">
                  <canvas id="chart-area" width="300" height="300">
                </div>
              </div>
              <div class="col-md-4 text-center">
                <h5 class="fw-bold">Usuarios con más compras</h5>
                <div id="canvas-holder">
                    <canvas id="chart-area2" width="300" height="300" />
                </div>

                <div id="chartjs-tooltip"></div>
              </div>
              <div class="col-md-4 text-center">
                <h5 class="fw-bold">Combos más vendidos</h5>
              <div id="canvas-holder" style="width:100%">
                <canvas id="chart-area1" width="300" height="300"/>
              </div>
              </div>
            </div>

            <div class="row mt-3">
              <h5 class="fw-bold">Ventas semanales</h5>
            <div style="width:100%">
                  <div>
                    <canvas id="canvas" height="200" width="600"></canvas>
                  </div>
                </div>
            </div>
          </div>
          


	<script>

		var doughnutData = [
				{
					value: <?php echo $countVenom?>,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Venom: Carnage liberado"
				},
				{
					value: <?php echo $countSpace?>,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "Space Jam"
				},
				{
					value: <?php echo $countBlack?>,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Black Widow"
				},
				{
					value: <?php echo $countSpider?>,
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "Spider-Man: lejos de casa"
				},
				{
					value: <?php echo $countJungle?>,
					color: "#4D5360",
					highlight: "#616774",
					label: "Jungle Cruise"
				}

			];

      //PASTEL 2
      Chart.defaults.global.customTooltips = function(tooltip) {

// Tooltip Element
  var tooltipEl = $('#chartjs-tooltip');

  // Hide if no tooltip
  if (!tooltip) {
      tooltipEl.css({
          opacity: 0
      });
      return;
  }

  // Set caret Position
  tooltipEl.removeClass('above below');
  tooltipEl.addClass(tooltip.yAlign);

  // Set Text
  tooltipEl.html(tooltip.text);

  // Find Y Location on page
  var top;
  if (tooltip.yAlign == 'above') {
      top = tooltip.y - tooltip.caretHeight - tooltip.caretPadding;
  } else {
      top = tooltip.y + tooltip.caretHeight + tooltip.caretPadding;
  }

  // Display, position, and set styles for font
    tooltipEl.css({
        opacity: 1,
        left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
        top: tooltip.chart.canvas.offsetTop + top + 'px',
        fontFamily: tooltip.fontFamily,
        fontSize: tooltip.fontSize,
        fontStyle: tooltip.fontStyle,
    });
  };

  var pieData = [{
    value: <?php echo $user1['COMPRAS']?>,
    color: "#F7464A",
    highlight: "#FF5A5E",
    label: "<?php echo $user1['NOMBRE']?>"
  }, {
    value: <?php echo $user2['COMPRAS']?>,
    color: "#46BFBD",
    highlight: "#5AD3D1",
    label: "<?php echo $user2['NOMBRE']?>"
  }, {
    value: <?php echo $user3['COMPRAS']?>,
    color: "#FDB45C",
    highlight: "#FFC870",
    label: "<?php echo $user3['NOMBRE']?>"
  }, {
    value: <?php echo $user4['COMPRAS']?>,
    color: "#949FB1",
    highlight: "#A8B3C5",
    label: "<?php echo $user4['NOMBRE']?>"
  }, {
    value: <?php echo $user5['COMPRAS']?>,
    color: "#4D5360",
    highlight: "#616774",
    label: "<?php echo $user5['NOMBRE']?>"
  }];

  // PASTEL 3
  var polarData = [
				{
					value: <?php echo $combo1['COMPRA']?>,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "<?php echo $combo1['NOMBRE']?>"
				},
				{
					value: <?php echo $combo2['COMPRA']?>,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "<?php echo $combo2['NOMBRE']?>"
				},
				{
					value: <?php echo $combo3['COMPRA']?>,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "<?php echo $combo3['NOMBRE']?>"
				},
				{
					value: <?php echo $combo4['COMPRA']?>,
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "<?php echo $combo4['NOMBRE']?>"
				},
				{
					value: <?php echo $combo5['COMPRA']?>,
					color: "#4D5360",
					highlight: "#616774",
					label: "<?php echo $combo5['NOMBRE']?>"
				},

			];

	</script> 

  <script>
    //GRAFICA DE VENTAS
    var randomScalingFactor = function(){ return Math.round(Math.random()*10000)};
		var lineChartData = {
			labels : ["Domingo","Lunes","Martes"],
			datasets : [
				{
					label: "My Second dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [<?php echo $domingo['TOTAL']?>,<?php echo $lunes['TOTAL']?>,<?php echo $martes['TOTAL']?>]
				}
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
    var ctx = document.getElementById("chart-area").getContext("2d");
				window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});

    var ctx2 = document.getElementById("chart-area2").getContext("2d");
    window.myPie = new Chart(ctx2).Pie(pieData);
    
    var ctx = document.getElementById("chart-area1").getContext("2d");
				window.myPolarArea = new Chart(ctx).PolarArea(polarData, {
					responsive:true
				});
	}
  </script>

  <!-- JQuery, Bundle.JS, Bootstrap JS -->
  <script src="../../assets/js/jquery.js"></script>
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>

  </body> 
</html>

<script>
  //Abrir / cerrar menu
  $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });
</script>

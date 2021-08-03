$(document).ready(function() {
    var id, opcion;
    opcion=4;

    //Abrir / cerrar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });

    //Inicializamos dataTable
    var tablaPelicula = $('#tablaPelicula').DataTable({
      "ajax":{
        "url": "crud.php",
        "method": 'POST',
        "data":{opcion:opcion},
        "dataSrc":""
      },
      "columns":[
       {"data": "ID_PELICULA"},
       {"data": "TITULO"},
       {"data": "SINOPSIS"},
       {"data": "DURACION"},
       {"data": "REPARTO"},
       {"data": "DIRECTOR"},
       {"data": "AÑO"},
       {"data": "ID_GENERO"},
       {"data": "ID_CLASIFICACION"},
       {"data": "ID_ESTADO"},
       {"defaultContent": "<div class='btn-group'><button class='btn btn-warning btnEditar'><i class='icon ion-md-create'></i></button><button class='btn btn-danger btnBorrar'><i class='icon ion-md-trash'></i></button></div>"}  
      ],
       
       //Para cambiar el lenguaje a español
   "language": {
           "lengthMenu": "Mostrar _MENU_ registros",
           "zeroRecords": "No se encontraron resultados",
           "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
           "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
           "infoFiltered": "(filtrado de un total de _MAX_ registros)",
           "sSearch": "Buscar:",
           "oPaginate": {
               "sFirst": "Primero",
               "sLast":"Último",
               "sNext":"Siguiente",
               "sPrevious": "Anterior"
            },
            "sProcessing":"Procesando...",
       }
   });

   var fila; //Capturar la fila para editar o borrar registro

   $("#frmPelicula").submit(function(e) {
    e.preventDefault(); //Evita que se recargue la pagina
    titulo = $.trim($("#titulo").val());
    genero = $.trim($("#genero").val());
    clasificacion = $.trim($("#clasificacion").val());
    sinopsis = $.trim($("#sinopsis").val());
    reparto = $.trim($("#reparto").val());
    director = $.trim($("#director").val());
    duracion = $.trim($("#duracion").val());
    año = $.trim($("#año").val());
    estado = $.trim($("#estado").val());
    portada = $.trim($("#portada").val());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, titulo:titulo, genero:genero, clasificacion:clasificacion, sinopsis:sinopsis, reparto:reparto, director:director, duracion:duracion, año:año, estado:estado, portada:portada, opcion:opcion},
      success: function(data){ // data es de CRUD.php
        console.log("Hola");
        tablaPelicula.ajax.reload(null,false);
      },
      error: function(response){
        console.log(response);
    }
    });
    $("#modalPelicula").modal("hide");
  });

  //Mostramos formulario
  $("#addPelicula").click(function(){
    id=null;
    opcion = 1;
    $("#frmPelicula").trigger("reset");
    $("#modalPelicula").modal("show");        
  });

    

  //Boton EDITAR
  $(document).on("click", ".btnEditar", function(){
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    titulo = fila.find('td:eq(1)').text();
    sinopsis = fila.find('td:eq(2)').text();
    duracion = fila.find('td:eq(3)').text();
    reparto = fila.find('td:eq(4)').text();
    director = fila.find('td:eq(5)').text();
    año = fila.find('td:eq(6)').text();
    genero = fila.find('td:eq(7)').text();
    clasificacion = fila.find('td:eq(8)').text();
    estado = fila.find('td:eq(9)').text();
    
    $("#titulo").val(titulo);
    $("#sinopsis").val(sinopsis);
    $("#duracion").val(duracion);
    $("#reparto").val(reparto);
    $("#director").val(director);
    $("#año").val(año);
    $("#genero").val(genero);
    $("#clasificacion").val(clasificacion);
    $("#estado").val(estado);

    $("#modalPelicula").modal("show");
  });

  //Boton BORRAR
  $(document).on("click", ".btnBorrar", function(){
    fila = $(this).closest("tr");
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3; //borrar
    $("#modalEliminar").modal("show");

    $("#btnSi").on("click", function(){
      $.ajax({
        url: "crud.php",
        type: "POST",
        dataType: "html",
        data: {opcion:opcion, id:id},
        success: function() {
          tablaPelicula.row(fila.parents('tr')).remove().ajax.reload(null,false); 
        },
        error: function(response){
          console.log(response);
        }
      });
      $("#modalEliminar").modal("hide");
    });

    $("#btnCancelar").on("click", function(){
      $("#modalEliminar").modal("hide");
    });

  });
    
});
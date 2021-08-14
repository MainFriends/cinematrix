$(document).ready(function() {
    var id, opcion;
    opcion=4;

    //Abrir / cerrar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });

    //Inicializamos dataTable
    var tablaCartelera = $('#tablaCartelera').DataTable({
      "ajax":{
        "url": "crud.php",
        "method": 'POST',
        "data":{opcion:opcion},
        "dataSrc":""
      },
      "columns":[
       {"data": "ID_CARTELERA"},
       {"data": "TITULO"},
       {"data": "HORA_INICIO"},
       {"data": "HORA_FIN"},
       {"data": "SALA"},
       {"data": "IDIOMA"},
       {"data": "FORMATO"},
       {"data": "FECHA"},
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

   $("#frmCartelera").submit(function(e) {
    e.preventDefault(); //Evita que se recargue la pagina
    pelicula = $.trim($("#pelicula").val());
    sala = $.trim($("#sala").val());
    horaInicio = $.trim($("#horaInicio").val());
    horaFin = $.trim($("#horaFin").val());
    idioma = $.trim($("#idioma").val());
    formato = $.trim($("#formato").val());
    fecha = $.trim($("#fecha").val());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, pelicula:pelicula, sala:sala, horaInicio:horaInicio, horaFin:horaFin, idioma:idioma, formato:formato, fecha:fecha, opcion:opcion},
      success: function(data){ // data es de CRUD.php
        tablaCartelera.ajax.reload(null,false);
      },
      error: function(response){
        console.log(response);
    }
    });
    $("#modalCartelera").modal("hide");
  });

  //Mostramos formulario
  $("#addCartelera").click(function(){
    id=null;
    opcion = 1;
    $("#frmCartelera").trigger("reset");
    $("#modalCartelera").modal("show");        
  });

    

  //Boton EDITAR
  $(document).on("click", ".btnEditar", function(){
    opcion = 5;
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id,opcion:opcion},
      success: function(data){ // data es de CRUD.php
        pelicula = data.ID_PELICULA
        sala = data.ID_SALA
        horaInicio = data.HORA_INICIO
        horaFin = data.HORA_FIN
        idioma = data.ID_IDIOMA
        formato = data.ID_FORMATO
        fecha = data.FECHA

        $("#pelicula").val(pelicula);
        $("#sala").val(sala);
        $("#horaInicio").val(horaInicio);
        $("#horaFin").val(horaFin);
        $("#idioma").val(idioma);
        $("#formato").val(formato);
        $("#fecha").val(fecha);

        opcion = 2;
        $("#modalCartelera").modal("show");
      },
      error: function(response){
        console.log(response);
    }
    });
  });

  //Boton BORRAR
  $(document).on("click", ".btnBorrar", function(){
    fila = $(this).closest("tr");
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    pelicula = parseInt(fila.find('td:eq(1)').text());
    opcion = 3; //borrar
    $("#modalEliminar").modal("show");

    $("#btnSi").on("click", function(){
      $.ajax({
        url: "crud.php",
        type: "POST",
        dataType: "html",
        data: {opcion:opcion, id:id, pelicula:pelicula},
        success: function() {
          tablaCartelera.row(fila.parents('tr')).remove().ajax.reload(null,false); 
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
$(document).ready(function() {
    var id, opcion;
    opcion=4;

    //Abrir / cerrar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });

    //Inicializamos dataTable
    var tablaAsiento = $('#tablaAsiento').DataTable({
      "ajax":{
        "url": "crud.php",
        "method": 'POST',
        "data":{opcion:opcion},
        "dataSrc":""
      },
      "columns":[
       {"data": "ID_ASIENTO"},
       {"data": "NUM_ASIENTO"},
       {"data": "ID_SALA"},
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

   $("#frmAsiento").submit(function(e) {
    e.preventDefault(); //Evita que se recargue la pagina
    numAsiento = $.trim($("#numAsiento").val());
    sala = $.trim($("#sala").val());
    estado = $.trim($("#estado").val());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, numAsiento:numAsiento, sala:sala, estado:estado, opcion:opcion},
      success: function(data){ // data es de CRUD.php
        tablaAsiento.ajax.reload(null,false);
      },
      error: function(response){
        console.log(response);
    }
    });
    $("#modalAsiento").modal("hide");
  });

  //Mostramos formulario
  $("#addAsiento").click(function(){
    id=null;
    opcion = 1;
    $("#frmAsiento").trigger("reset");
    $("#modalAsiento").modal("show");        
  });

  //Boton EDITAR
  $(document).on("click", ".btnEditar", function(){
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    numAsiento = fila.find('td:eq(1)').text();
    sala = fila.find('td:eq(2)').text();
    estado = fila.find('td:eq(3)').text();
    
    $("#numAsiento").val(numAsiento);
    $("#sala").val(sala);
    $("#estado").val(estado);

    $("#modalAsiento").modal("show");
  });

  //Boton BORRAR
  $(document).on("click", ".btnBorrar", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3; //borrar
    var respuesta = confirm("¿Esta seguro de borrar "+id+"?");
    if(respuesta){
     $.ajax({
        url: "crud.php",
        type: "POST",
        dataType: "html",
        data: {opcion:opcion, id:id},
        success: function() {
          tablaAsiento.row(fila.parents('tr')).remove().ajax.reload(null,false); 
        },
        error: function(response){
          console.log(response);
        }
      });
    }
  });
  
    
});
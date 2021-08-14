$(document).ready(function() {
    var id, opcion;
    opcion=4;

    //Abrir / cerrar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });

    //Inicializamos dataTable
    var tablaProgra = $('#tablaProgra').DataTable({
      "ajax":{
        "url": "crud.php",
        "method": 'POST',
        "data":{opcion:opcion},
        "dataSrc":""
      },
      "columns":[
       {"data": "ID_PPROMO"},
       {"data": "PROMOCION"},
       {"data": "FECHA_INICIO"},
       {"data": "FECHA_FIN"},
       {"data": "ESTADO"},
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

   $("#frmProgra").submit(function(e) {
    e.preventDefault(); //Evita que se recargue la pagina
    promo = $.trim($("#promo").val());
    fechaI = $.trim($("#fechaI").val());
    fechaF = $.trim($("#fechaF").val());
    estado = $.trim($("#estado").val());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, promo:promo, fechaI:fechaI, fechaF:fechaF, estado:estado, opcion:opcion},
      success: function(data){ // data es de CRUD.php
        tablaProgra.ajax.reload(null,false);
      },
      error: function(response){
        console.log(response);
    }
    });
    $("#modalProgra").modal("hide");
  });

  //Mostramos formulario
  $("#addProgra").click(function(){
    id=null;
    opcion = 1;
    $("#frmProgra").trigger("reset");
    $("#modalProgra").modal("show");        
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
        promo = data.ID_PROMO
        fechaI = data.FECHA_INICIO
        fechaF = data.FECHA_FIN
        estado = data.ID_ESTADO

        $("#promo").val(promo);
        $("#fechaI").val(fechaI);
        $("#fechaF").val(fechaF);
        $("#estado").val(estado);
        
        opcion = 2;
        $("#modalProgra").modal("show");
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
    opcion = 3; //borrar
    $("#modalEliminar").modal("show");

    $("#btnSi").on("click", function(){
      $.ajax({
        url: "crud.php",
        type: "POST",
        dataType: "html",
        data: {opcion:opcion, id:id},
        success: function() {
          tablaProgra.row(fila.parents('tr')).remove().ajax.reload(null,false); 
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
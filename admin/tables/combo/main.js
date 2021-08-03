$(document).ready(function() {
    var id, opcion;
    opcion=4;

    //Abrir / cerrar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });

    //Inicializamos dataTable
    var tablaCombo = $('#tablaCombo').DataTable({
      "ajax":{
        "url": "crud.php",
        "method": 'POST',
        "data":{opcion:opcion},
        "dataSrc":""
      },
      "columns":[
       {"data": "ID_COMBO"},
       {"data": "NOMBRE"},
       {"data": "DESCRIPCION"},
       {"data": "PRECIO"},
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

   $("#frmCombo").submit(function(e) {
    e.preventDefault(); //Evita que se recargue la pagina
    nombre = $.trim($("#nombre").val());
    descripcion = $.trim($("#descripcion").val());
    precio = $.trim($("#precio").val());
    imagen = $.trim($("#imagen").val());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, nombre:nombre, descripcion:descripcion, precio:precio, imagen:imagen, opcion:opcion},
      success: function(data){ // data es de CRUD.php
        tablaCombo.ajax.reload(null,false);
      },
      error: function(response){
        console.log(response);
    }
    });
    $("#modalCombo").modal("hide");
  });

  //Mostramos formulario
  $("#addCombo").click(function(){
    id=null;
    opcion = 1;
    $("#frmCombo").trigger("reset");
    $("#modalCombo").modal("show");        
  });

  //Boton EDITAR
  $(document).on("click", ".btnEditar", function(){
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    descripcion = fila.find('td:eq(2)').text();
    precio = parseInt(fila.find('td:eq(3)').text());
    
    $("#nombre").val(nombre);
    $("#descripcion").val(descripcion);
    $("#precio").val(precio);

    $("#modalCombo").modal("show");
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
          tablaCombo.row(fila.parents('tr')).remove().ajax.reload(null,false); 
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
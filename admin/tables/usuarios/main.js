$(document).ready(function() {
    var id, opcion;
    opcion=2;

    //Abrir / cerrar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });

    //Inicializamos dataTable
    var tablaUsuario = $('#tablaUsuario').DataTable({
      "ajax":{
        "url": "crud.php",
        "method": 'POST',
        "data":{opcion:opcion},
        "dataSrc":""
      },
      "columns":[
       {"data": "ID_USUARIO"},
       {"data": "NOMBRE"},
       {"data": "APELLIDO"},
       {"data": "CORREO"},
       {"data": "ROL"},
       {"data": "TELEFONO"},
       {"data": "FECHA_NACIMIENTO"},
       {"data": "PAIS"},
       {"data": "CIUDAD"},
       {"defaultContent": "<div class='btn-group'><button class='btn btn-warning btnEditar'><i class='icon ion-md-create'></i>"}  
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

  //Boton EDITAR
  $(document).on("click", ".btnEditar", function(){
    opcion = 3;
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, opcion:opcion},
      success: function(data){
        id_rol = data.ID_ROL
        $("#rol").val(id_rol);
        $("#modalUsuario").modal("show");
      },
      error: function(response){
        console.log(response);
      }
    });
  });

  //Enviar rol
  $("#btnListo").click(function(e){
    e.preventDefault();
    opcion = 1
    rol = $.trim($("#rol").val());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, rol:rol, opcion:opcion},
      success: function(data){
        tablaUsuario.ajax.reload(null,false);
        $("#modalUsuario").modal("hide");
      },
      error: function(response){
        console.log(response);
      }
    });
  });
    
});
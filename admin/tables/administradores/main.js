$(document).ready(function() {
    var id, opcion;
    opcion=3;

    //Abrir / cerrar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });

    //Inicializamos dataTable
    var tablaAdmin = $('#tablaAdmin').DataTable({
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

   $("#frmAdmin").submit(function(e) {
    e.preventDefault(); //Evita que se recargue la pagina
    nombre = $.trim($("#nombre").val());
    apellido = $.trim($("#apellido").val());
    correo = $.trim($("#correo").val());
    pass = $.trim($("#pass").val());
    tel = $.trim($("#tel").val());
    city = $.trim($("#city").val());
    pais = $.trim($("#pais").val());
    date = $.trim($("#date").val());
    genero = $.trim($("#genero").val());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {nombre:nombre, apellido:apellido, correo:correo, pass:pass, tel:tel, city:city, pais:pais, date:date, genero:genero, opcion:opcion},
      success: function(data){ // data es de CRUD.php
        tablaAdmin.ajax.reload(null,false);
      },
      error: function(response){
        console.log(response);
    }
    })
    $("#modalAdmin").modal("hide");
  });

  //Mostramos formulario
  $("#addAdmin").click(function(){
    id=null;
    opcion = 1;
    $("#frmAdmin").trigger("reset");
    $("#modalAdmin").modal("show");        
  });


  //Boton EDITAR
  $(document).on("click", ".btnEditar", function(){
    opcion = 2; //editar
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
        $("#editarAdmin").modal("show");
      },
      error: function(response){
        console.log(response);
      }
    });
  });
  
  // ENVIAR
  $("#editListo").click(function(e){
    e.preventDefault();
    opcion = 4
    rol = $.trim($("#rol").val());
    console.log(rol)
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, rol:rol, opcion:opcion},
      success: function(data){
        tablaAdmin.ajax.reload(null,false);
        $("#editarAdmin").modal("hide");
      },
      error: function(response){
        console.log(response);
      }
    });
  });
    
});
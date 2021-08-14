$(document).ready(function() {
    var id, opcion;
    opcion=4;

    //Abrir / cerrar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });

    //Inicializamos dataTable
    var tablaPromo = $('#tablaPromo').DataTable({
      "ajax":{
        "url": "crud.php",
        "method": 'POST',
        "data":{opcion:opcion},
        "dataSrc":""
      },
      "columns":[
       {"data": "ID_PROMO"},
       {"data": "NOMBRE"},
       {"data": "DESCRIPCION"},
       {"data": "CATEGORIA"},
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

   $("#frmPromo").submit(function(e) {
    e.preventDefault(); //Evita que se recargue la pagina
    nombre = $.trim($("#nombre").val());
    descripcion = $.trim($("#descripcion").val());
    categoria = $.trim($("#categoria").val());
    precio = $.trim($("#precio").val());
    imagen = $.trim($("#imagen").val());
    $.ajax({
      url: "crud.php",
      type: "POST",
      dataType: "json",
      data: {id:id, nombre:nombre, descripcion:descripcion, categoria:categoria, precio:precio, imagen:imagen, opcion:opcion},
      success: function(data){ // data es de CRUD.php
        tablaPromo.ajax.reload(null,false);
      },
      error: function(response){
        console.log(response);
    }
    });
    $("#modalPromo").modal("hide");
  });

  //Mostramos formulario
  $("#addPromo").click(function(){
    id=null;
    opcion = 1;
    $("#frmPromo").trigger("reset");
    $("#modalPromo").modal("show");        
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
        nombre = data.NOMBRE
        descripcion = data.DESCRIPCION
        categoria = data.ID_CATEGORIA
        precio = data.PRECIO
        imagen = data.IMAGEN

        $("#nombre").val(nombre);
        $("#descripcion").val(descripcion);
        $("#categoria").val(categoria);
        $("#precio").val(precio);
        $("#imagen").val(imagen);

        opcion = 2;
        $("#modalPromo").modal("show");
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
          tablaPromo.row(fila.parents('tr')).remove().ajax.reload(null,false); 
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
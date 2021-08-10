$(document).ready(function(){
    //Desactivar boton
    $("#continuar").addClass('disabled'); //Desactivar boton continuar
    $('.target').prop('selectedIndex','0'); //Reiniciar select al cargar página
    
    $(".target").on("change",function(){  // Si cambian los select con class target
        var valorSelect=$(this).val()//obtenemos el valor seleccionado en una variable
        if (valorSelect>0){
            $("#continuar").removeClass('disabled');
            $("#continuar").click(function(){
                $.ajax({
                    url: "inc/detalleVenta.php",
                    type: "POST",
                    dataType: "json",
                    data: {valorSelect:valorSelect},
                    success: console.log("Funciono")
                  });
            });
            
        }else{
            $("#continuar").addClass('disabled');
        }
    }); 
});

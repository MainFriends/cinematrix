$(document).ready(function(){
    //Desactivar boton
    $("#continuar").addClass('disabled');
    
    $(".target").on("change",function(){  // Si cambian los select con class target
        var valorSelect=$(this).val()//obtenemos el valor seleccionado en una variable
        if (valorSelect>0){
            $("#continuar").removeClass('disabled');
        }else{
            $("#continuar").addClass('disabled');
        }
    });

});
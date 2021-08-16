$(document).ready(function(){
    //Desactivar boton
    $("#continuar").addClass('disabled'); //Desactivar boton continuar
    $('.ADULTREGULAR2D-CM').prop('selectedIndex','0'); //Reiniciar select al cargar página
    $('.CINEPAREJA2D-CM').prop('selectedIndex','0'); //Reiniciar select al cargar página
    
    //Habilitar / Desabilitar boton Continuar
    $(".ADULTREGULAR2D-CM").on("change",function(){  // Si cambian los select con class target
        CINEPACKPAREJA2DHN = $.trim($(".CINEPAREJA2D-CM").val());
        var selectADULTREGULAR=$(this).val()//obtenemos el valor seleccionado en una variable
        if (selectADULTREGULAR>0){
            $("#continuar").removeClass('disabled');
        }
        if((selectADULTREGULAR<1) && (CINEPACKPAREJA2DHN<1)){
            $("#continuar").addClass('disabled'); 
        }
    }); 

    $(".CINEPAREJA2D-CM").on("change",function(){  // Si cambian los select con class target
        ADULTREGULARHO = $.trim($(".ADULTREGULAR2D-CM").val());
        var selectCINEPACKPAREJA2D=$(this).val()//obtenemos el valor seleccionado en una variable
        if (selectCINEPACKPAREJA2D>0){
            $("#continuar").removeClass('disabled');
        }
        if((selectCINEPACKPAREJA2D<1) && (ADULTREGULARHO<1)){
            $("#continuar").addClass('disabled');
        }
    }); 

    //Pasar cantidad de boletos por ajax
    $("#continuar").click(function(){
        selectADULTREGULAR = $.trim($(".ADULTREGULAR2D-CM").val());
        selectCINEPACKPAREJA2DUO = $.trim($(".CINEPAREJA2D-CM").val())*2;
        $.ajax({
            url: "inc/detalleVenta.php",
            type: "POST",
            dataType: "json",
            data: {selectADULTREGULAR:selectADULTREGULAR, selectCINEPACKPAREJA2DUO:selectCINEPACKPAREJA2DUO},
            success: console.log("Funciono")
          });
    }); 
});

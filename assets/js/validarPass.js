$(document).ready(function(){
    $("#newPass").prop('disabled', true);

    $('#pass2').keyup(function(){

        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();

        if(pass1 == pass2){
            $('#msg').text("").css("color","green");
            $("#newPass").prop('disabled', false); 
        }else{
            $('#msg').text("La contraseña no es igual").css("color","red")
            $("#newPass").prop('disabled', true);
        }

        if(pass2 == ""){
            $('#msg').text("Vuelve a introducir la contraseña").css("color","red"); 
            $("#newPass").prop('disabled', true);
        }
    });   


});
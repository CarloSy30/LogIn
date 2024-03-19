$(document).ready(function() {



    $('#newPassword').keyup(function(){
        const value = $(this).val();
        const hasLetters = /[A-Za-z]/;
        const hasNumbers = /[0-9]/;

        $('#weak').show();
        $('#medium').show();
        $('#strong').show();
        $('#password-description').show();

        if(hasLetters.test(value) && hasNumbers.test(value) && value.length >= 10){
            $('#weak').css({"background-color":"red"});
            $('#medium').css({"background-color":"orange"});
            $('#strong').css({"background-color":"green"});
            $('#password-description').text('Password is strong');
            $('#password-description').css({"color":"green"});
        }else if(hasLetters.test(value) && hasNumbers.test(value)){
            $('#weak').css({"background-color":"red"});
            $('#medium').css({"background-color":"orange"});
            $('#strong').css({"background-color":"white"});
            $('#password-description').text('Password is medium');
            $('#password-description').css({"color":"orange"});
        }else if(hasLetters.test(value)){
            $('#weak').css({"background-color":"red"});
            $('#medium').css({"background-color":"white"});
            $('#strong').css({"background-color":"white"});
            $('#password-description').text('Password is weak');
            $('#password-description').css({"color":"red"});
        }else if(hasNumbers.test(value)){
            $('#weak').css({"background-color":"red"});
            $('#medium').css({"background-color":"white"});
            $('#strong').css({"background-color":"white"});
            $('#password-description').text('Password is weak');
            $('#password-description').css({"color":"red"});
        }else{
            $('#weak').hide();
            $('#medium').hide();
            $('#strong').hide();
            $('#password-description').hide();
        }     
        
    });


    $('#confirmPassword').keyup(function(){
        const value = $(this).val();
        $('#passwordrepeat-description').show();

        if(value == ""){
            $('#passwordrepeat-description').hide();
        }

        if(value == $('#newPassword').val()){
            $('#passwordrepeat-description').text('Password Matched');
            $('#passwordrepeat-description').css({"color":"green"});
        }else{
            $('#passwordrepeat-description').text('Password Incorrect');
            $('#passwordrepeat-description').css({"color":"red"});
        }

       

        
    });

})
$(document).ready(function() {

    //PHONE VALIDATION
    $('#phoneNumber').on('input', function() {
        const inputValue = $(this).val();

        // Set the maximum number of digits allowed
        const maxLength = 11;

        // If the length of the input value exceeds the maximum length, trim it
        if (inputValue.length > maxLength) {
            $(this).val(inputValue.slice(0, maxLength));
        }
    });

    //PREVENT ANY LETTERS AND SYMBOLS IN PHONE
    $('#phoneNumber').on('keypress', function(e) {
        const hasLetters = /[0-9]/; // Regular expression for alphabetic characters

        // Prevent the key from being entered if it's not alphabetic
        if (!hasLetters.test(e.key)) {
            e.preventDefault(); 
        }
    });

    // INPUT PREVENT NUMBER IN NAME FIELD
    $('#fullName').on('keypress', function(e) {
        const hasLetters = /[A-Za-z]/; // Regular expression for alphabetic characters

        // Prevent the key from being entered if it's not alphabetic
        if (!hasLetters.test(e.key)) {
            e.preventDefault(); 
        }
    });

    //PASSWORD STRENGTH INDICATOR
    $('#password').keyup(function(){
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


    //PASSWORD REPEAT INDICATOR
    $('#repeatPassword').keyup(function(){
        const value = $(this).val();
        $('#passwordrepeat-description').show();

        if(value == ""){
            $('#passwordrepeat-description').hide();
        }

        if(value == $('#password').val()){
            $('#passwordrepeat-description').text('Password Matched');
            $('#passwordrepeat-description').css({"color":"green"});
        }else{
            $('#passwordrepeat-description').text('Password Incorrect');
            $('#passwordrepeat-description').css({"color":"red"});
        }

       

        
    });

    // CHECK ALL TEXTFIELDS FOR BUTTON ACTIVE INDICATOR
    $('#signup-form').keyup(function(){
        const all = $('.input_info');
        $textField = 0;
        
        all.each(function(){
            if($(this).val().trim() !== ""){
                $textField++;
            }else{
                $textField--;
            }
        });

        if($textField === all.length){
            $('#register-button').prop('disabled', false);
            console.log("check ", $textField);
        }else{
            $('#register-button').prop('disabled', true);
            console.log("wrong ", $textField);
        }
    });

});

const OTPinputs = document.querySelectorAll('.otp_input')
const button = document.querySelector('#btn_otp')

window.onload = ()=> OTPinputs[0].focus()


OTPinputs.forEach((input)=>{
    input.addEventListener('input', ()=>{
        const currentInput = input
        const nextInput = currentInput.nextElementSibling

        if(currentInput.value.length > 1 && currentInput.value.length == 2){
            currentInput.value = ""
        }


        if(nextInput !== null && nextInput.hasAttribute('disabled') && currentInput.value !== ""){
            nextInput.removeAttribute('disabled')
            nextInput.focus()
        }

        if(!OTPinputs[3].disabled && OTPinputs[3].value !== ""){ 
            button.classList.add("active")
        }else{
            button.classList.remove('active')
        }
    })

    input.addEventListener('keyup', (e)=>{
        console.log(e);
        if(e.key == "Backspace"){
            if(input.previousElementSibling != null){
                e.target.value = ""
                e.target.setAttribute("disabled", true)
                input.previousElementSibling.focus()
            }
        }
    })
})
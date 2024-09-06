<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $num1 = $_POST['otp1'];
    $num2 = $_POST['otp2'];
    $num3 = $_POST['otp3'];
    $num4 = $_POST['otp4'];

    $fourDigitsOTP = $num1.$num2.$num3.$num4;

    //YUNG SESSION DITO AY GALING SA signup.php | insertInfos() and sendOTP() 
    $signupcontr = new signupcontr($_SESSION['email']);
    // $result = $signupcontr->activateAccount($_SESSION['otp'], $fourDigitsOTP);
    
    if($result == "account_activated"){
        session_unset();
        session_destroy();
        unset($_POST['otp1'],$_POST['otp2'],$_POST['otp3'],$_POST['otp4']);
        //ANG STATUS DITO AY GAGAMITIN PARA MAG DISPLAY NG ALERT BOX SA index.php
        header("Location: index.php?status=$result");

    }
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/otpForm.css">
    <title>OTP</title>
</head>
<body style="background-color:#fffdf2;">

    <div class="container">
        <h2>Input the OTP</h2>
        <form action="#" method="post"> <!-- You should replace 'process_otp.php' with the actual filename of your PHP script -->
            <div class="input_fields">
                <input type="number" name="otp1">
                <input type="number" name="otp2" disabled>
                <input type="number" name="otp3" disabled>
                <input type="number" name="otp4" disabled>
            </div>
            <button type="submit">Verify OTP</button>
        </form>

    </div>
    <script src="javascript/otpForm.js"></script>
</body>
</html>
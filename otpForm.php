<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $num1 = $_POST['otp1'];
    $num2 = $_POST['otp2'];
    $num3 = $_POST['otp3'];
    $num4 = $_POST['otp4'];
    // echo var_dump($num1);
    $OTP = $num1.$num2.$num3.$num4;
    if($OTP == 4321){
        echo "correct";
    }else{
        echo "incorrect";
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
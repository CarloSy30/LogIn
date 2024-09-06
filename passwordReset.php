<?php
session_start();

if(!isset($_SESSION['passwordTokens']) && !isset($_SESSION['forgotEmail'])){
    header("Location: index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_SESSION['forgotEmail'];
    $tokens = $_SESSION['passwordTokens'];
    
    include 'classes/Dbh.class.php';
    include 'classes/signupmodel.class.php';
    include 'classes/forgetPasswordcontr.class.php';
    include 'classes/signupview.class.php';

    $forgotPasswordcontr = new forgotPasswordcontr($email, $newPassword, $confirmPassword, $tokens);
    $reset = $forgotPasswordcontr->passwordReset();

    $signupview = new signupview();
    $result = $signupview->showAlert($reset);
    
    unset($_POST['newPassword'], $_POST['confirmPassword']);
    //SESSION AND POST VARIABLES ARE DONE TO UNSET
    if($reset == "password_updated" || $reset == "expired_tokens"){
        session_unset();
        session_destroy();
        
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/passwordReset.css">

    <title>Password Reset</title>
</head>
<body style="background-color:#fffdf2;">
    <div class="container-fluid">

        <form class="mx-auto" action="#" method="post">
               <!-- PHP ALERT BOX -->
               <?php
                  $displayAlert = isset($result)? $result : '';
                  echo $displayAlert;

                ?>
            <h4 class="text-center">Forgot Password</h4>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input disabled type="text" value="<?php echo isset($_SESSION['forgotEmail']) ? htmlentities($_SESSION['forgotEmail']) : null?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">    
            </div>
            <div class="mb-3 mt-2">
                <label for="exampleInputEmail1" class="form-label">New Password</label>
                <input type="password" name="newPassword" id="newPassword" class="form-control" id="exampleInputEmail1" aria-describedby="newPassword">    
                <div id="password-indicator">
                    <span id="weak"></span>
                    <span id="medium"></span>
                    <span id="strong"></span>
                </div>
                <small id="password-description"></small>
            </div>
            <div class="mb-3 mt-2">
                <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" id="exampleInputEmail1" aria-describedby="confirmPassword">    
                <div id="passwordrepeat-indicator">
                    <small id="passwordrepeat-description"></small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="buttonSubmit">Submit</button>
            <div class="row" id="loginLink">
                <small id="right-signup">Already have an account? <a href="index.php">Login</a></small>
            </div>
        </form>
    </div>
    <script src="javascript/passwordReset.js"></script>
</body>
</html>
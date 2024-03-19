<?php
require_once 'config.php';
// session_start();
if(isset($_SESSION['passwordTokens'])){
    header("Location: passwordReset.php");
    exit();
}
if(isset($_SESSION['account_id'])){
    header("Location: LANDLORD/dashboard.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    include 'classes/Dbh.class.php';
    include 'classes/signupmodel.class.php';
    include 'classes/signupcontr.class.php';
    include 'classes/signupview.class.php';

    $signupcontr = new signupcontr($email, $password); 
    $logged = $signupcontr->loginProcess();
    
    if($logged == 'correct' && isset($_SESSION['account_id'])){
        header("Location: LANDLORD/dashboard.php");
        exit();

    }

    $signupview = new signupview();
    $result = $signupview->showAlert($logged);
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <title>Boostrap Login | Ludiflex</title>
</head>
<body style="background-color:#fffdf2;">
    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

       
        <div class="row rounded-5 box-area " id="login-container">
            <!--------------------------- Left Box ----------------------------->
    
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box " id="left-box">
                <div class="featured-image mb-3 logo">
                    <img src="images/logo.png" class="rounded-circle mt-4" style="width: 300px;">
                </div>
                <p class="text-white fs-2 pt-3 mb-1 logo" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">FLAT OS</p>
                <p class="text-white mb-3"><small>Home Sweet Apartment</small></p>
            </div> 

            <!-------------------- ------ Right Box ---------------------------->
            <div class="col-md-6 right-box" id="right-box">
                <form action="#" method="post">  
                        <div class="row align-items-center">
                            <?php
                                $displayaAlert = isset($result)? $result : '';
                                echo $displayaAlert;

                            ?>
                                <div class="header-text mb-4" id="right-header">
                                    <h2>Hello,Again Tenants and Adminssss</h2>
                                    <p>We are happy to have you back.</p>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="email" value = "<?php echo $data = isset($_POST['email']) ? htmlentities($_POST['email']) : null ?>" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                                </div>
                                <div class="input-group mb-1">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                                </div>
                                <div class="input-group mb-5 d-flex justify-content-between">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="formCheck">
                                        <label for="formCheck" class="form-check-label text-secondary"><small>Show password</small></label>
                                    </div>
                                    <div class="forgot">
                                        <small><a href="forgotPassword.php">Forgot Password?</a></small>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-lg btn-primary w-100 fs-6" id="right-btn">Login</button>
                                </div>
                                <div class="row" >
                                    <small id="right-signup">Don't have account? <a href="signup.php"> Sign Up</a></small>
                                </div>
                        </div>
                </form>
            </div> 
      </div>
    </div>
    <script src="javascript/index.js"></script>
</body>
</html>
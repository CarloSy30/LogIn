<?php
session_start();
if(isset($_SESSION['account_id'])){
    header("Location: test.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];

    include 'classes/Dbh.class.php';
    include 'classes/signupmodel.class.php';
    include 'classes/forgetPasswordcontr.class.php';
    include 'classes/signupview.class.php';

    $forgotPasswordcontr = new forgotPasswordcontr($email);
    // $requested = $forgotPasswordcontr->passwordResetLink();

    // $signupview = new signupview();
    // $result = $signupview->showAlert($requested);

    echo $forgotPasswordcontr->verifyAccount();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/forgotPassword.css">

    <title>Forgot Password</title>
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
                <input type="text" value="<?php echo $data = isset($_POST['email']) ? htmlentities($_POST['email']) : null ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">    
            </div>
            <button type="submit" class="btn btn-primary" id="buttonSubmit">Submit</button>
            <div class="row" id="loginLink">
                <small id="right-signup">Already have an account? <a href="index.php">Login</a></small>
            </div>
        </form>
       
    </div>
    
</body>
</html>
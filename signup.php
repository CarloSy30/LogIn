<?php
session_start();

if(isset($_SESSION['account_id'])){
  header("Location: test.php");
  exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repeatPassword = $_POST['repeatPassword'];
  $phoneNumber = $_POST['phoneNumber'];

  include 'classes/Dbh.class.php';
  include 'classes/signupmodel.class.php';
  include 'classes/signupcontr.class.php';
  include 'classes/signupview.class.php';

  $signupcontr = new signupcontr($email, $password, $repeatPassword, $name, $phoneNumber);
  $inserted = $signupcontr->insertInfos();

  $signupview = new signupview();
  $result = $signupview->showAlert($inserted);

  if($inserted == "correct"){
    unset($name, $email, $phoneNumber);
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
    <link rel="stylesheet" href="css/signup.css">
    <title>Sign up</title>
</head>
<body style="background-color:#fffdf2;">
<section class="vh-100" >
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11" id="main-cont">
        <div id="border">
          <div class="card-body p-md-5">
            <div class="row justify-content-center" id="main-row">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                <!-- PHP ALERT BOX -->
                <?php
                  $displayAlert = isset($result)? $result : '';
                  echo $displayAlert;
                ?>
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-1">Create Account</p>
               
                <form action="#" method="post" class="mx-1 mx-md-4" id="signup-form">

                    <div class="d-flex flex-row align-items-center mb-1">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" name="name" value = "<?php echo $data = isset($name) ? htmlentities($name) : null ?>" id="fullName" class="form-control bg-light" placeholder="Name"/>
                        <label class="form-label" for="fullName"></label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-1">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" name="phoneNumber" value = "<?php echo $data = isset($phoneNumber) ? htmlentities($phoneNumber) : null ?>" id="phoneNumber" class="form-control bg-light" placeholder="Phone number" />
                        <label class="form-label" for="phoneNumber"></label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-1">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" name="email" value = "<?php echo $data = isset($email) ? htmlentities($email) : null ?>" id="email" class="form-control bg-light" placeholder="Email"/>
                        <label class="form-label" for="email"></label>
                      </div>           
                    </div>

                    <div class="d-flex flex-row align-items-center mb-1">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" name="password" id="password" class="form-control bg-light" placeholder="Password" autocomplete="new-password"/>
                        <label class="form-label" for="password"></label>
                        <div id="password-indicator">
                          <span id="weak"></span>
                          <span id="medium"></span>
                          <span id="strong"></span>
                        </div>
                        <small id="password-description"></small>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-1">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-4">
                        <input type="password" name="repeatPassword" id="repeatPassword" class="form-control bg-light" placeholder="Repeat your password"/>
                        <label class="form-label" for="repeatPassword"></label>
                        <div id="passwordrepeat-indicator">
                          <small id="passwordrepeat-description"></small>
                        </div>
                       
                      </div>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button id="register-button" type="submit" class="btn btn-primary btn-lg" style="width: 500px;" disabled>Register</button>
                    </div>
                    <div class="row" id="login">
                      <small id="right-signup">Already have an account? <a href="index.php">Login</a></small>
                  </div>
                </form>     
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                <img src="images/sidelogo.png"
                   alt="Sample image" style="width:600px" id="right-logo">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="javascript/signup.js"></script>
</body>
</html>
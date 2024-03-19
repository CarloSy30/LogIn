<?php
require_once '../config.php';
// session_start();

if(!isset($_SESSION['account_id'])){
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Document</title>
</head>
<body style="background-color:#fffdf2;">
    <?php include_once('navigation.php') ?>
    <?php
        echo $_SESSION['account_id'];
        echo "<br>";
        echo session_id();
    ?>
    <div class="container">
        <div class="row" id="test">
            <a class="col-md-4 mb-3 link" href="tenant.php">
                <div class="ps-md-4 border-left border-5 border-success">
                    <div class="row align-items-center" style="border-left: 5px solid green;">
                         <div class="col">
                            <h4>Tenants</h4>
                            <h5>12</h5>
                        </div>
                        <div class="col">
                            <p class="pt-2 text-end"><i class="bi bi-people-fill fa-2x"></i></p>
                        </div>
                    </div>
                </div>
            </a>
            <a class="col-md-4 mb-3 link">
                <div class="ps-md-4 border-left border-5 border-primary">
                    <div class="row align-items-center" style="border-left: 5px solid green;">
                        <div class="col">
                            <h4>Income</h4>
                            <h5>30,000</h5>
                        </div>
                        <div class="col">
                            <p class="pt-2 text-end"><i class="bi bi-piggy-bank-fill fa-2x"></i></p>
                        </div>
                    </div>
                </div>
            </a>
            <a class="col-md-4 mb-3 link">
                <div class="ps-md-4 border-left border-5 border-warning">
                    <div class="row align-items-center" style="border-left: 5px solid green;">
                        <div class="col">
                            <h4>Debt</h4>
                            <h5>20,000</h5>
                        </div>
                        <div class="col">
                            <p class="pt-2 text-end"><i class="bi bi-exclamation-diamond-fill fa-2x"></i></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

</body>
</html>
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
    <title>Document</title>
</head>
<body style="background-color:#fffdf2;">
    <?php include_once('navigation.php') ?>
    <?php
            echo $_SESSION['account_id'];
            echo "<br>";
            echo session_id();
    ?>
</body>
</html>
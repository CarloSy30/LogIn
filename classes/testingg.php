<?php

include 'Dbh.class.php';
include 'signupmodel.class.php';
include 'signupview.class.php';

// $signupmodel = new signupmodel();
// $res = $signupmodel->getTokens("dancarlooooo30@gmail.com");

// echo var_dump($res['expiry_tokens']);
$signupView = new signupview();
$result = $signupView->showAlert('email_sent');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>testinggg</title>
</head>
<body>
    <?php
    echo $result;

    ?>
</body>
</html>
<?php

session_start();
session_unset();
session_destroy();
if(!isset($_SESSION['account_id'])){
    header("Location: index.php");
    exit();
}


    
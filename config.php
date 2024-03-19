<?php
ini_set('session.use_strict_mode',1);
session_start();
if(!isset($_SESSION['account_id'])){
    session_regenerate_id(true);
}
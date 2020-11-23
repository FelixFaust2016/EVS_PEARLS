<?php
    // start session
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }

    // import database
    include_once '../config/database.php';
?>
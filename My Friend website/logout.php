<?php 
    session_start();
    $_SESSION["email"] = array();
    $_SESSION["user_id"] = array();
    session_destroy();
    header("Location: index.php");
?>
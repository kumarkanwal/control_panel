<?php
// require header( )
// session_start();
session_start();
if( $_SESSION['login'] == false){
    header("location: login.php");
    die();
}


?>
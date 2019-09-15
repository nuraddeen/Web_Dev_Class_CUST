<?php 
//check if seesion of user id was set and unset it
session_start();

if (isset($_SESSION["user_id"])) {
    unset($_SESSION["user_id"]);
}

//redirect
header("Location: PhpClass6.php");


?>
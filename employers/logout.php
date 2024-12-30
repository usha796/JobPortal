<?php
session_start(); 

unset($_SESSION['emplogin']);
session_destroy(); // destroy session
header("location:emp-login.php"); 
?>


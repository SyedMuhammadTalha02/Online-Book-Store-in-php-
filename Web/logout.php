<?php   
session_start(); 
session_destroy(); 
unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
unset($_SESSION["user_role"]);
header("location:sign_in.php"); 
exit();
?>
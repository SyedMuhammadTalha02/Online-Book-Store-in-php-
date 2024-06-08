<?php
error_reporting(0);
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "e_projectdb";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

<?php
// Database connection configuration
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "expense_manager";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
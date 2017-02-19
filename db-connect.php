<?php
$servername = "localhost";
$username = "pi_drive_user";
$password = "pass";
$database = "pi_drive";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
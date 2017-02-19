<?php
    require "db-connect.php";
   session_start();
   $query = "UPDATE users SET online=0 WHERE name='".$_SESSION['username']."'";
    mysqli_query($conn, $query);
   
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   echo 'You are being logged out. Please wait.';
   header('Refresh: 1; URL = index.php');
?>
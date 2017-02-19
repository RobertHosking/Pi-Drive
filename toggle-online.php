<?php
include 'db-connect.php';
session_start();
$online = $_REQUEST['online'];
$query = "UPDATE users SET streaming=".$online." WHERE name='".$_SESSION['username']."'";
mysqli_query($conn, $query);
echo $online;
?>
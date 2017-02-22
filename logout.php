<?php
    require "db-connect.php";
   require "head.php";
   session_start();
   
   $query = "UPDATE users SET online=0 WHERE name='".$_SESSION['username']."'";
    mysqli_query($conn, $query);
   
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
?>

<body>
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="col-xs-4 col-xs-offset-4" style="">
            <div class="center-block">
                <h1 class="text-center" style="font-family:helvetica; font-weight:bold;">Logging out.<h2>
                <img class="center-block" src="images/default.svg"></img>
            </div>
        </div>
    </div>
</body>




<?php

   header('Refresh: 2; URL = index.php');

?>
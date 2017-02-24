<?php
  require "head.php";
$trash = 'drive/Temp/Trash/';
session_start();

if (!file_exists($trash)) {
    mkdir($trash, 0777, true);
}


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
                <h1 class="text-center" style="font-family:helvetica; font-weight:bold;">Moving <?php echo $_REQUEST['target'];?> to Trash<h2>
                <img class="center-block" src="images/default.svg"></img>
            </div>
        </div>
    </div>
</body>





<?php

if(isset($_REQUEST['target'])){
    rename($_SESSION['dir'].$_REQUEST['target'], $trash.$_REQUEST['target']);
}
header('Refresh: 0; URL = index.php');
?>